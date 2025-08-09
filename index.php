<?php
// Ton tableau produit avec images et titres
$produits = [
    'masekafood.png' => 'Maseka Food',
    'Black-Forest-Gateau_Header.jpg' => 'Black Forest Gâteau',
    'maseka.png'=> 'Maseka',
    'gateau-d-anniversaire-aux-confettis.jpg'=> 'Gâteau Anniversaire Confettis',
    'gateau_etage.png'=> 'Gâteau à Étages',
    'Mini-gateaux-etages-au-chocolat.jpg'=> 'Mini Gâteaux Chocolat',
    'summer_party_gateau_61495_16x9.jpg'=>'Summer Party Gâteau',
    '5-recettes-de-gateau-original.jpg'=>'5 Recettes de Gâteaux',
    'gateau-simple.png'=>'Gâteau Simple',
    'Recettes-de-gateaux.jpg'=>'Recettes de Gâteaux',
    'produits.png'=>'Produits Divers',
    'gateau-au-chocolat.jpg' =>'Gâteau au Chocolat',

    
    // ajoute tes autres images ici...
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Maseka Food - Accueil Animé avec slider</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

<main>
  <h2>Bienvenue chez Maseka Food !</h2>
  <p>Découvrez nos délicieux gâteaux et spécialités sucrées.</p>

  <div class="slider-container" id="slider">
    <div class="slides">
      <?php foreach ($produits as $img => $titre): ?>
        <img src="image/<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($titre); ?>">
      <?php endforeach; ?>
    </div>
  </div>


<!-- Wrapper bouton rond avec animation -->
<div class="commande-wrapper">
  <a href="produits.php" class="btn-commander" aria-label="Passer maintenant votre commande">
    <span> Maseka food </span>
    <!-- Bulles rigolotes et bébé stylisé sous le texte -->
    <div class="baby-wrapper">
      <div class="baby-bubble">
        <div class="baby-head">
          <div class="eye left"></div>
          <div class="eye right"></div>
          <div class="mouth"></div>
          <div class="arm"></div>
        </div>
      </div>
      <div class="door">
        <div class="door-frame"></div>
        <div class="door-panel"></div>
      </div>
    </div>
  </a>
</div>

</main>


<script>
  // Code simple pour faire défiler les images toutes les 3s
  const slides = document.querySelector('.slides');
  const totalImages = slides.children.length;
  let currentIndex = 0;

  function slideShow() {
    currentIndex++;
    if(currentIndex >= totalImages) {
      currentIndex = 0;
    }
    slides.style.transform = `translateX(${-320 * currentIndex}px)`;
  }

  // On lance la fonction après la fin des animations d'apparition (2.8s + marge)
  setTimeout(() => {
    // faire apparaitre le slider (au cas où opacity 0)
    document.getElementById('slider').style.opacity = '1';
    document.getElementById('slider').style.transform = 'scale(1)';
    setInterval(slideShow, 3000);
  }, 2800);
</script>

<?php include 'footer.php'; ?>
</body>
</html>
