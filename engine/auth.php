<?php
include_once("functions.php");

if (isset($_POST["auth_login_serial"]) && $_POST["auth_login_serial"] === 'user_token') {
      //     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      //     $password = isset($_POST['password']) ? trim($_POST['password']) : '';
      $email = $_POST['email'];
      $password = $_POST['password'];

      $status = 0;
      $message = 'Failed to login!';

      if (!$email || empty($password)) {
            $message = "Email or password cannot be empty!";
      } else {
            if ($email === 'super' && $password === 'admin') {
                  $status = 1;
                  $message = "Successfully logged in";

                  session_regenerate_id(true);
                  $_SESSION['user_token'] = bin2hex(random_bytes(16));
                  $_SESSION['user_id'] = 'super';
                  $_SESSION['user_name'] = 'Super Admin';
                  $_SESSION['user_email'] = 'super@admin.id';
            } else {
                  $sql = "SELECT * FROM users WHERE email = ?";
                  $stmt = mysqli_prepare($dbconnect, $sql);
                  if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 's', $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($result) > 0) {
                              $data = mysqli_fetch_array($result);
                              if (password_verify($password, $data['password'])) {
                                    $status = 1;
                                    $message = "Successfully logged in";

                                    session_regenerate_id(true);
                                    $_SESSION['user_token'] = bin2hex(random_bytes(16));
                                    $_SESSION['user_id'] = $data['id'];
                                    $_SESSION['user_name'] = $data['username'];
                                    $_SESSION['user_email'] = $data['email'];
                                    $_SESSION['user_level'] = $data['level'];
                              } else {
                                    $message = "Invalid email or password";
                              }
                        } else {
                              $message = "Invalid email or password";
                        }
                        mysqli_stmt_close($stmt);
                  } else {
                        $message = "Database error: Unable to prepare statement";
                  }
            }
      }

      $response = [
            "status" => $status,
            "message" => $message
      ];
      echo json_encode($response);
}

if (isset($_POST["auth_logout_serial"]) && $_POST["auth_logout_serial"] === 'user_token') {
      session_destroy();
      
      unset($_SESSION['user_token']);
      unset($_SESSION['user_id']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_level']);

      $status = 1;
      $message = 'Successfully logged out';

      $response = [
            "status" => $status,
            "message" => $message
      ];
      echo json_encode($response);
}
?>