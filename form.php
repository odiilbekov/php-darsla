<!DOCTYPE html>
<html lang="uz">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post yuborish shakli</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .post-form {
      background-color: #fff;
      padding: 25px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 400px;
    }

    .post-form h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    .post-form label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #555;
    }

    .post-form input[type="text"],
    .post-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      transition: border-color 0.3s;
    }

    .post-form input[type="text"]:focus,
    .post-form textarea:focus {
      border-color: #007BFF;
      outline: none;
    }

    .post-form button {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .post-form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>

  <form class="post-form" action="data.php" method="POST">
    <h2>Yangi Post</h2>
      <label> for="sarlavha">Sarlavha</label>
      <input type="text" id="sarlavha" name="sarlavha" required>

      <label for="matn">Matn</label>
      <textarea id="matn" name="matn" rows="6" required>

      </textarea>

      <button type="submit">Yuborish</button>
    </form>

</body>

</html>