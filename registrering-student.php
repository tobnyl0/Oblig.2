<?php  /* registrer-student */
/*
/*  Programmet lager et html-skjema for å registrere en student
/*  Programmet registrerer data (studentkode og student) i databasen
*/
?>

<h3>Registrer student </h3>

<form method="post" action="" id="registrerstudentSkjema" name="registrerstudentSkjema">
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Klassekode 
  <select name="Klassekode" id="Klassekode" required>
    <?php
      include("db-tilkobling.php");
      $sql = "SELECT Klassekode FROM Klassekode ORDER BY Klassekode;";
      $resultat = mysqli_query($db, $sql);

      while ($rad = mysqli_fetch_array($resultat)) {
        $kode = $rad["Klassekode"];
        echo "<option value='$kode'>$kode</option>";
      }
    ?>
  </select>
  <br/>
  <input type="submit" value="Registrer Student" id="registrerStudentkodeKnapp" name="registrerStudentkodeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST["registrerStudentkodeKnapp"])) {
    $fornavn = $_POST["fornavn"];
    $etternavn = $_POST["etternavn"];
    $brukernavn = $_POST["brukernavn"];
    $Klassekode = $_POST["Klassekode"];

    if (!$Klassekode || !$etternavn || !$brukernavn || !$fornavn) {
      print("Både fornavn, etternavn, brukernavn og klassekode må fylles ut");
    } else {
      include("db-tilkobling.php");

      $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat); 

      if ($antallRader != 0) {
        print("Studenten er allerede registrert");
      } else {
        $sqlSetning = "INSERT INTO student VALUES('$fornavn','$etternavn', '$brukernavn', '$Klassekode');";
        mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

        print("Følgende student er nå registrert: $fornavn $etternavn ($brukernavn) i klasse $Klassekode");
      }
    }
  }
?>