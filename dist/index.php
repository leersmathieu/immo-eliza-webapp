<?php
require_once '../assets/php/reset.php';
$appear = "beforeSubmit";
$bgAnimation = "";
if (isset($_POST['submit'])) {
    $bgAnimation = "bg_animation";
    $appear = "appear";
    $disappear = "disappear";
    $args = array(
        'street' => array('sanitize' => FILTER_SANITIZE_STRING,
            'validate' => FILTER_VALIDATE_REGEXP),

        'type' => array('sanitize' => FILTER_SANITIZE_INT,
            'validate' => FILTER_VALIDATE_BOOLEAN),

        'city' => array('sanitize' => FILTER_SANITIZE_STRING,
            'validate' => FILTER_VALIDATE_REGEXP),

        'number' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_INT),

        'terrace' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_BOOLEAN),

        'garden' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_BOOLEAN),

        'kitchen' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_BOOLEAN),

        'status' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_BOOLEAN),

        'room' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_INT),

        'surface' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_INT),

        'postal' => array('sanitize' => FILTER_SANITIZE_NUMBER_INT,
            'validate' => FILTER_VALIDATE_INT),
    );
    $info = filter_input_array(INPUT_POST, $args);

    $street = $info['street'];
    $number = $info['number'];
    $postal = $info['postal'];
    $city = $info['city'];
    $type = $info['type'];
    $surface = $info['surface'];
    $room = $info['room'];
    $status = $info['status'];
    $garden = $info['garden'];
    $terrace = $info['terrace'];
    $kitchen = $info['kitchen'];

    require_once '../assets/php/API.php';
    $prediction = new openPrediction('apiKey');
    $predictionResult = $prediction->getPrediction($info);

    require_once '../assets/php/3Dapi.php';
    $test = new open3D('apiKey');
    $testResult = $test->get3D($info);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Immo Eliza">
    <meta name="keywords" content="HTML, CSS, PHP, Python">
    <meta name="author" content="Mathieu, Vincent, Yannick, Jonathan">
    <title>Immo ELiza</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="../assets/js/inputRange.js"></script>
    <?php echo "<script src='main.js'></script>"; ?>
</head>

<body class="<?php echo $bgAnimation ?>">
  <header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light static-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/images/immoEliza1.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Formulaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  </header>

    <section class="container-fluid <?php echo $disappear ?>" id="formSection">
      <div class="row">
        <div class="col-12 col-md-6 offset-md-3 mainForm boxShadow">
          <form method="post">
            <h2>Formulaire</h2>
            <div class="form-row">
              <div class="form-group col-9">
                <label for="street">Rue</label>
                <input required type="text" class="form-control" name="street" />
              </div>
              <div class="form-group col-3">
                <label for="number">Numéro</label>
                <input required type="number" class="form-control" name="number" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-3">
                <label for="postal">Code postal</label>
                <input required type="number" class="form-control" name="postal" />
              </div>
              <div class="form-group col-9 mt-auto">
                <label for="city">Ville</label>
                <input required type="text" class="form-control" name="city" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-8 mt-auto">
                <label for="surface">Surface habitable</label>
                <div class="d-flex align-items-center">
                  <input required type="range" min="10" max="300" class="form-control" id="valueInput" name="surface" />
                  <p id="valueTarget" class="m-0">155m²</p>
                </div>

              </div>
              <div class="form-group col-4 mt-auto">
                <label for="room">Nombre de pièce(s)</label>
                <select class="form-control" name="room">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </div>
            <div class="form-row">
            <div class="form-group col-3 mt-auto">
                <label for="status">Etat du bien</label>
                <select class="form-control" name="status">
                  <option value="1">Neuf</option>
                  <option value="0">Ancien</option>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="garden">Jardin</label>
                <select class="form-control" name="garden">
                  <option value="1">Oui</option>
                  <option value="0">Non</option>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="terrace">Terrasse</label>
                <select class="form-control" name="terrace">
                  <option value="1">Oui</option>
                  <option value="0">Non</option>
                </select>
              </div>
              <div class="form-group col-3">
                <label for="kitchen">Cuisine équipée</label>
                <select class="form-control" name="kitchen">
                  <option value="1">Oui</option>
                  <option value="0">Non</option>
                </select>
              </div>
            </div>

            <div class="form-row d-flex flex-column">
              <label class="form-check-label"> Type de bien</label>
              <div class="d-flex">
                <div class="form-check typeCard p-0">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="type"
                    value="1"
                    id="house"
                  />
                  <label for="house">
                    <img
                      class="typeImg"
                      src="../assets/images/home.svg"
                      alt="house"
                    />
                    <p>Maison</p>
                  </label>
                </div>
                <div class="form-check typeCard">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="type"
                    value="0"
                    id="apartment"
                  />
                  <label for="apartment">
                    <img
                      class="typeImg"
                      src="../assets/images/apart.svg"
                      alt="apartment"
                    />
                    <p>Appartement</p>
                  </label>
                </div>
              </div>
            </div>
            <input class="d-none" type="text" id="fake" name="fake" value="">
            <button type="submit" class="submitButton" name="submit" id="submitButton">
              Submit
            </button>
          </form>

        </div>
      </div>
    </section>

    <section class="container-fluid <?php echo $appear; ?>" id="afterSubmit">
      <div class="row">
        <div class="col col-md-8 offset-md-2 info boxShadow">
          <div class="d-flex justify-content-around">
            <div>
              <h3>Votre bien</h3>
              <ul class="list-unstyled">
                <li>Type :  <?php if ($type) {echo "Maison";} else {echo "Appartement";}?></li>
                <li>Adresse : <?php echo "$number $street, $postal $city" ?></li>
                <li>Nombre de pièce(s) : <?php echo $room ?></li>
              </ul>
            </div>
              <ul class='list-unstyled mt-auto'>
                <li>Surface habitable: <?php echo $surface ?> m²</li>
                <li>Etat du bien : <?php if ($status) {echo "neuf";} else {echo "ancien";}?></li>
                <li>Jardin : <?php if ($garden) {echo "oui";} else {echo "non";}?></li>
              </ul>
              <ul class='list-unstyled mt-auto'>
                <li>Terrasse: <?php if ($terrace) {echo "oui";} else {echo "non";}?></li>
              </ul>
          </div>
          <p class="mb-0">
              Prix estimé : <?php echo $predictionResult ?>
              </p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 col-md-4 offset-md-1 p-0 d-flex align-items-center">
            <iframe class="boxShadow map" width="100%" height="400" src="https://maps.google.com/maps?q=<?php echo $street . '+' . $number . '+' . $postal . '+' . $city; ?>&output=embed"></iframe>
        </div>
        <div id="3dTarget" class="col-12 col-md-5 offset-md-1 p-0 mt-4 mt-md-0">

        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="page-footer font-small pt-4">
        <!-- Footer Links -->
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-6 mt-md-0 mt-3">
                    <!-- Content -->
                    <h5 class="text-uppercase">Utilité de l'application</h5>
                    <p>L'application permettra de faire une prédiction de prix pour une habitation selon plusieurs critères définis.</p>
                </div>
                <hr class="w-100 d-lg-none">
                <div class="col-lg-6 mb-md-0">
                    <!-- Contact -->
                    <h5 class="text-uppercase">Contact</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://github.com/leersmathieu">Mathieu (AI)</a>
                        </li>
                        <li>
                            <a href="https://github.com/paradous/">Vincent (AI)</a>
                        </li>
                        <li>
                            <a href="https://github.com/Yaco-99/">Yannick (Web dev)</a>
                        </li>
                        <li>
                            <a href="https://github.com/deschuyteneerj/">Jonathan (Web dev)</a>
                        </li>
                    </ul>
                </div>
                <hr class="w-100 d-lg-none">
            </div>
        </div>
        <!-- Footer Links -->
        <!-- Copyright -->
        <div class="footer-copyright text-center pb-3">© 2020 Copyright:
            <a href="#"> immoeliza.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <!-- JS, Popper.js, and jQuery -->
    <script src="../node_modules/jquery/dist/jquery.slim.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
