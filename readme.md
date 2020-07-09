Overview
--
Grep data dari [Prodeskel Bina Pemdes](http://prodeskel.binapemdes.kemendagri.go.id/mpublik/) Kementrian Dalam Negeri.


Replace reg expression
-

- find (`regex`) and clear 
  ```sh
   class="scGrid(?:.*)"
  ```

- find (`regex`) clear tag `<rowspan>`

  ```sh
   [rowspan](?:.*)"
   ```

- clear tag `` ` `` replace dengan `&apos;
`
- find and clear `</span>`
---

SQL Filtering
-

Sangat banyak kesalahan yg terjadi dalam penginputan data oleh operator, maka dari itu diperlukan filter agar field terisi dengan baik.


Update column yg kosong:
- Kode desa yang masih kosong
  ```sql
  UPDATE adm INNER JOIN desa ON adm.desa=desa.desa SET adm.kode=desa.kode
  ```
- untuk kode desa yang salah input / tidak valid, kosongkan column secara manual atau :
  ```sql
  UPDATE nama_table AS satu SET satu.kode='' WHERE satu.desa='nama_desa'
  ```
  Lalu update column yg kosong
  ```sql
  UPDATE nama_table_yg_akan_diupdate AS satu INNER JOIN isi_table_referensi AS dua ON satu.desa=dua.desa AND satu.kec=dua.kec SET satu.kode=dua.kode WHERE satu.kode =''
  ```
