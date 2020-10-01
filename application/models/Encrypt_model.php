<?php
/**
|--------------------------------------------------------------------------|
| Copyright Notice                                                         |
|--------------------------------------------------------------------------|
| TOLONG UNTUK TIDAK MENGUBAH-UBAH SCRIPT DALAM HALAMAN INI TANPA          |
| SEIZIN DARI PEMILIK SOURCE CODE. HARAGAILAH SETIAP PEKERJAAN YANG        |
| TELAH DILAKUKAN OLEH PEMBUAT APLIKASI INI. JIKA ANDA INGIN MENGUBAH      |
| SEBAGIAN ATAU SELURUH KODE YANG ADA DALAM SCRIPT DIBAWAH INI TOLONG      |
| HUBUNGI E-MAIL AUTHOR!!!.                                                |
|--------------------------------------------------------------------------|
 */
/**
 * @package sikejo
 * @author alif firdi <aliffirdi07@gmail.com>
 * @copyright 2020
 * @link https://aliffirdi.me
 * @since 1.0.0 beta
 */
class encrypt_model extends CI_Model
{
    public function encode($isi_teks = null)
    {
            $iv     = '4153295424527581';
            $pass   = '97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjj&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11e#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh';
            $method = 'AES256';

            $hasil = openssl_encrypt($isi_teks, $method, $pass,OPENSSL_RAW_DATA,$iv);
            $hasil = bin2hex($hasil);
            $hasil = base64_encode($hasil);
            
            return $hasil;
    }
    public function decode($isi_teks = null)
    {
            $isi_teks   = base64_decode($isi_teks);
            $isi_teks   = hex2bin($isi_teks);
            $iv         = '4153295424527581';
            $pass       = '97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjj&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11e#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh97a2955d-a1dd-11ea-8086-88d7f69e)(*&^%$#@!(*&!@#$)(*&^@#$%@DFGjtfgHBKJFTYGBkjjgBHjjkyGh';
            $method     = 'AES256';

            $hasil = openssl_decrypt($isi_teks, $method, $pass,OPENSSL_RAW_DATA,$iv);
            
            return $hasil;
    }
}