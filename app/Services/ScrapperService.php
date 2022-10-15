<?php

namespace App\Services;

use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;

class ScrapperService {

  private $nim;
  private $password;

  public function __construct(string $nim, string $password) {
    $this->nim = $nim;
    $this->password = $password;
  }

  public function scrapUser(): array {
    $cookieJar = new SessionCookieJar('PHPSESSID', true);
    $http = new Client();
    $user = [];

    try {
      $response = $http->request('POST', 'https://siam.ub.ac.id/index.php', [
        'headers' => [
          'User-Agent' => 'Wangsit KBMSI',
          'Content-Type' => 'application/x-www-form-urlencoded',
        ],
        'form_params' => [
          'status_loc' =>	"Unable+to+retrieve+your+location",
          'lat' =>	"",
          'long' =>	"",
          'username' => $this->nim,
          'password' => $this->password,
          'login' => "Masuk"
        ],
        'cookies' => $cookieJar
      ]);

      $html = $response->getBody()->getContents();
      $dom = $this->getDom($html);

      $user['nim'] = $dom->evaluate('//div[@class="bio-info"]/div[1]/b[1]/text()')[0]->nodeValue;
      $user['nama'] = $dom->evaluate('//div[@class="bio-info"]/div[2]/text()')[0]->nodeValue;
      $announcement = substr($dom->evaluate('//section[@id="announcement"]/div[1]/p/text()')[0]->nodeValue, 51);
      $user['email'] = substr($announcement, 0, strlen($announcement) - 1);
      $angkatan = substr($user['nim'], 0, 2);
      $nim = $user['nim'];
      $user['profile_pic'] = "https://siakad.ub.ac.id/dirfoto/foto/foto_20$angkatan/$nim.jpg";

      $response = $http->request('GET', 'https://siam.ub.ac.id/biodata.tampil.php', [
        'cookies' => $cookieJar
      ]);

      $html = $response->getBody()->getContents();
      $dom = $this->getDom($html);

      $tgl_lahir = $dom->evaluate('//table[@class="tampilbio"]/tr[3]/td[2]/text()')[0]->nodeValue;
      $user['hp'] = $dom->evaluate('//table[@class="tampilbio"]/tr[23]/td[2]/text()')[0]->nodeValue;
      $user['tgl_lahir'] = $this->parseDate($tgl_lahir);
      $user['password'] = bcrypt($this->password);

      $http->request('GET', 'https://siam.ub.ac.id/logout.php', [
        'cookies' => $cookieJar
      ]);

      return $user;
    } catch(Exception $e) {
      return [];
    }
  }

  private function getDom(string $html): DOMXPath {
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($html);
    return new DOMXPath($doc);
  }

  private function parseDate(string $date): Carbon {
    $MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $date = explode(' ', $date);
    $d = $date[0];
    $m = array_search($date[1], $MONTHS) + 1;
    $y = $date[2];

    return Carbon::create($y, $m, $d, 0, 0, 0, 'Asia/Jakarta');
  }
}