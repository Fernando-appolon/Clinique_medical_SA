<?php
// Activer l'affichage des erreurs pour le débogage
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include 'includes/header.php';
include 'includes/db.php';

try {
    // Récupérer tous les services depuis la base de données
    // // $stmt = $pdo->query("SELECT * FROM services ORDER BY title");
    // $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Debug: Vérifier si des services sont récupérés
    if (empty($services)) {
        $services = array(); // Éviter les erreurs si la table est vide
    }
} catch (PDOException $e) {
    echo "<div class='error-message'>Erreur de base de données : " . $e->getMessage() . "</div>";
    $services = array();
}
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Nos Services Médicaux</h1>
            <p>Découvrez l'ensemble de nos services et spécialités médicales</p>
        </div>
    </section>

    <section class="services-list">
        <div class="container">
            <?php if (empty($services)): ?>
                <div class="no-services">
                    <h3>Aucun service disponible pour le moment</h3>
                    <p>Veuillez contacter l'administrateur du site.</p>
                </div>
            <?php else: ?>
                <div class="services-grid">
                    <?php foreach($services as $service): ?>
                    <div class="service-card-large">
                        <div class="service-header">
                            <div class="service-icon">
                                <?php echo !empty($service['icon']) ? $service['icon'] : '🏥'; ?>
                            </div>
                            <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                        </div>
                        <div class="service-content">
                            <p><?php echo htmlspecialchars($service['description']); ?></p>
                            <a href="appointment.php" class="btn-secondary">Prendre rendez-vous</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Vous avez des questions sur nos services ?</h2>
                <p>Notre équipe est à votre disposition pour vous renseigner</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn-primary">Nous contacter</a>
                    <a href="appointment.php" class="btn-secondary">Prendre RDV</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>