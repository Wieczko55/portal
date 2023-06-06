<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal społecznościowy</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<body>
    <div id="banery">
        <header id="ba1">
            <h2>Nasze osiedle</h2>
        </header>
        <header id="ba2">
            <?php
            $polaczenie = mysqli_connect("localhost","root","","portal_ter");
            $sql = "SELECT COUNT(*) FROM dane";
            $wynik = mysqli_query($polaczenie,$sql);
            while ($r = mysqli_fetch_row($wynik)) {
                echo "Liczba użytkowników portalu: ".$r[0];
            }
            ?>
        </header>
    </div>
    <div id="sekcje">
    <section id="le">
        <h3>Logowanie</h3>
        <form action="uzytkownicy.php" method="post">
            Login <br>
            <input type="text" name="login"> <br>
            Hasło <br>
            <input type="password" name="haslo"> <br>
            <button type="submit">Zaloguj</button>            
        </form>
    </section>
    <section id="pr">
        <h3>Wizytówka</h3>
        <div id="wiza">
            <?php
                if(!empty($_POST["login"])&& !empty($_POST["haslo"]))
                {
                $login = $_POST["login"];
                $haslo = sha1($_POST["haslo"]);
                $zapytanie1 = "SELECT haslo FROM uzytkownicy WHERE login in ('$login')";
                $wynik1 = mysqli_query($polaczenie,$zapytanie1);
                if($re = mysqli_fetch_row($wynik1))
                 {
                    if($haslo == $re[0])
                    {
                        $zapytanie2 = "SELECT  dane.rok_urodz, dane.przyjaciol, dane.hobby, dane.zdjecie, YEAR(CURDATE())-rok_urodz AS 'lat' FROM uzytkownicy JOIN dane on uzytkownicy.id = dane.id WHERE uzytkownicy.login in ('$login')";
                        $wynik2 = mysqli_query($polaczenie, $zapytanie2);
                        if($linia2 = mysqli_fetch_row($wynik2))
                        {
                                     echo "<img src='$linia2[3]' alt='osoba'>";
                                     echo "<h4> ".$login." (".$linia2[4].")"."</h4>";
                                     echo "<p>hobby: ".$linia2[2]."</p>";
                                     echo "<h1><img src='icon-on.png' alt='serce'>".$linia2[1]."</h1>";
                                     echo "<button>"."<a href='dane.html'>Więcej Informacji </a>"."</button>";
                        }
                    }
                    else
                    {
                        echo "złe hasło";
                    }
                  }
                  else
                  {
                     echo "zły login";
                  }
                }
                ?>       
            </div>
        </section>
    </div>
    <footer>
        Stronę wykonał: 000000000
    </footer>
 <?php
    mysqli_close($polaczenie);
 ?>
</body>
</html>