<?php
// Activer l'affichage des erreurs pour le débogage
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include 'includes/header.php';
include 'includes/db.php';

try {
    // Récupérer tous les médecins depuis la base de données
    // $stmt = $pdo->query("SELECT * FROM doctors ORDER BY name");
    // $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Debug: Vérifier si des médecins sont récupérés
    if (empty($doctors)) {
        $doctors = array(); // Éviter les erreurs si la table est vide
    }
} catch (PDOException $e) {
    echo "<div class='error-message'>Erreur de base de données : " . $e->getMessage() . "</div>";
    $doctors = array();
}
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Notre Équipe Médicale</h1>
            <p>Découvrez nos professionnels de santé dévoués à votre bien-être</p>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <?php if (empty($doctors)): ?>
                <div class="no-doctors">
                    <h3>Notre équipe est en cours de constitution</h3>
                    <p>Revenez bientôt pour découvrir nos professionnels de santé.</p>
                </div>
            <?php else: ?>
                <div class="team-grid">
                    <?php foreach($doctors as $doctor): ?>
                    <div class="doctor-card">
                        <div class="doctor-image">
                            <?php if (!empty($doctor['image'])): ?>
                                <img src="assets/images/<?php echo htmlspecialchars($doctor['image']); ?>" alt="Dr. <?php echo htmlspecialchars($doctor['name']); ?>">
                            <?php else: ?>
                                <div class="doctor-placeholder">
                                    <span>👨‍⚕</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="doctor-info">
                            <h3>Dr. <?php echo htmlspecialchars($doctor['name']); ?></h3>
                            <p class="specialty"><?php echo htmlspecialchars($doctor['specialty']); ?></p>
                            <p class="description"><?php echo htmlspecialchars($doctor['description']); ?></p>
                            <div class="doctor-actions">
                                <a href="appointment.php?doctor=<?php echo $doctor['id']; ?>" class="btn-primary">Prendre RDV</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="team-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($doctors); ?>+</div>
                    <div class="stat-label">Médecins</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Spécialités</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Années d'expérience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Urgences</div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Rencontrez notre équipe</h2>
                <p>Prenez rendez-vous avec le professionnel de santé qui correspond à vos besoins</p>
                <div class="cta-buttons">
                    <a href="appointment.php" class="btn-primary">Prendre rendez-vous</a>
                    <a href="contact.php" class="btn-secondary">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>