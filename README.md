# API Client Sistem Informasi dan Manajemen Data Center (SIMDC)

## Cara menjalankan
- Unduh API Client, simpan pada folder htdocs XAMPP
- Ubah nama folder API Client menjadi ``inventory``
- Masuk ke dalam folder ``inventory`` melalui terminal, bisa dengan klik kanan pada Windows Explorer -> "Git bash here", atau melalui terminal pada Visual Studio Code
- Jalankan perintah ``composer install``
- Pastikan Apache dan MySQL pada XAMPP telah di-_start_
- Jalankan API Server Spring dengan perintah ``mvn spring-boot:run``
- Buka API Client melalui browser pada URL http://localhost/inventory

## Fungsi Khusus API Request
| Fungsi | Keterangan | Return |
|--|--|--
| ``apiGet(string $endpoint)`` | Untuk melakukan permintaan API GET. Dibutuhkan satu parameter untuk endpoint. Contoh ``apiGet('users')``. | Array |
| ``apiPost(string $endpoint, array $data)`` | Untuk melakukan permintaan API POST. Dibutuhkan dua parameter untuk endpoint dan form data. Contoh ``apiPost('users', ['username' => 'foo', 'userpass' => 'bar', ...])`` | Array |
| ``apiPut(string $endpoint, array $data)`` | Untuk melakukan permintaan API PUT. Dibutuhkan dua parameter untuk endpoint dan form data. Contoh ``apiPut('users/1', ['username' => 'foo', 'userpass' => 'bar', ...])``. | Array |
| ``apiDelete(string $endpoint)`` | Untuk melakukan permintaan API DELETE. Dibutuhkan satu parameter untuk endpoint. Contoh ``apiDelete('users/1')``. | Array |


**PERHATIAN**: endpoint ditulis tanpa awalan dan akhiran slash (/)

### Contoh implementasi pada controller
```
<?php
defined('BASEPATH')  OR  exit('No direct script access allowed');

class  Test extends  CI_Controller  {

	public  $output;

	public  function  index()
	{
		// Mengambil data semua user
		$data =  apiGet('users');
		$this->output->set_content_type('application/json')>set_output(json_encode($data));
	}
}
```
### Output
![Output API](https://github.com/noplanalderson/inventory/blob/main/assets/images/output_json.png)
