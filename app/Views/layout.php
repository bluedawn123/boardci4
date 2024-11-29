<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
  
    <div class="container">
      <header class="d-flex justify-content-between">
        <h1><a href="/">Home</a></h1>
        <nav>
        <?php
          if($user = session('userid')) { 
        ?>
          <ul class="d-flex">            
            <li><a href="/about">About Us</a></li>
            <li><a href="/board">게시판</a></li>
            <li><a href="">mypage</a></li> 
            <li><a href="/logout">logout</a></li>
          </ul>
          <?php
            } else{
          ?>          
          <ul class="d-flex">
            <li><a href="/about">About Us</a></li>
            <li><a href="/board">게시판</a></li>                       
            <li><a href="/login">login</a></li>
          </ul>
          <?php
            }
          ?>                
        </nav>
      </header>
      <main>
        <?php echo $content; ?>
      </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
