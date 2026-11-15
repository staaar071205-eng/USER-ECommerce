<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
      // Mencari user berdasarkan email dan memeriksa password.
      // Mengembalikan data user jika cocok, atau false jika gagal.
      public function login($email, $password)
      {
            $sql = "SELECT * FROM tb_users WHERE user_email=:user_email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_email", $email);
            $stmt->execute();

            $user = $this->select($stmt);

            if (!$user || !$this->cekPassword($password, $user['user_password'])) {
                  return false;
            }

            // Hash lama (PASSWORD() MySQL) otomatis diganti ke hash modern
            if (password_needs_rehash($user['user_password'], PASSWORD_DEFAULT)) {
                  $this->gantiPassword($user['user_id'], $password);
            }

            return $user;
      }

      // Membandingkan password yang diketik dengan hash di database
      private function cekPassword($password, $hash)
      {
            // Format lama: "*" + SHA1(SHA1(password)), hasil fungsi PASSWORD() MySQL
            if (str_starts_with($hash, '*')) {
                  $lama = '*' . strtoupper(sha1(sha1($password, true)));
                  return hash_equals($hash, $lama);
            }

            return password_verify($password, $hash);
      }

      private function gantiPassword($id, $password)
      {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE tb_users SET user_password=:user_password WHERE user_id=:user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":user_password" => $hash, ":user_id" => $id]);
      }

      public function tampil()
      {
            $sql = "SELECT * FROM tb_users ORDER BY user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function jumlah()
      {
            $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM tb_users");
            $stmt->execute();

            return (int) $this->select($stmt)['total'];
      }

      public function simpan()
      {
            $sql = "INSERT INTO tb_users SET
                        user_nama=:user_nama,
                        user_email=:user_email,
                        user_password=:user_password";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                  ":user_nama"     => trim($_POST['user_nama']),
                  ":user_email"    => trim($_POST['user_email']),
                  ":user_password" => password_hash($_POST['user_password'], PASSWORD_DEFAULT),
            ]);
      }

      public function edit($id)
      {
            $sql = "SELECT * FROM tb_users WHERE user_id=:user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":user_id", $id);
            $stmt->execute();

            return $this->select($stmt);
      }

      // Password hanya diganti jika kolom password diisi
      public function update()
      {
            $data = [
                  ":user_nama"  => trim($_POST['user_nama']),
                  ":user_email" => trim($_POST['user_email']),
                  ":user_id"    => $_POST['user_id'],
            ];

            $set = "user_nama=:user_nama, user_email=:user_email, updated_at=NOW()";

            if (($_POST['user_password'] ?? '') !== '') {
                  $set .= ", user_password=:user_password";
                  $data[":user_password"] = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
            }

            $stmt = $this->db->prepare("UPDATE tb_users SET $set WHERE user_id=:user_id");
            $stmt->execute($data);
      }

      public function hapus($id)
      {
            $stmt = $this->db->prepare("DELETE FROM tb_users WHERE user_id=:user_id");
            $stmt->bindParam(":user_id", $id);
            $stmt->execute();
      }
}
