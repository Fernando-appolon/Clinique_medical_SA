<?php
// Activer l'affichage des erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/header.php';

// Vérifier si le fichier de connexion existe
if (!file_exists('includes/db.php')) {
    die("<div class='error-message'>Fichier includes/db.php introuvable!</div>");
}

include 'includes/db.php';

// Initialiser les variables
$doctors_count = 0;
$services_count = 0;

// Récupérer les statistiques si la connexion est établie
// if ($pdo) {
//     try {
//         // Compter le nombre de médecins
//         $stmt = $pdo->query("SELECT COUNT(*) as count FROM doctors");
//         $result = $stmt->fetch(PDO::FETCH_ASSOC);
//         $doctors_count = $result['count'] ?? 0;
        
//         // Compter le nombre de services
//         // $stmt = $pdo->query("SELECT COUNT(*) as count FROM services");
//         // $result = $stmt->fetch(PDO::FETCH_ASSOC);
//         // $services_count = $result['count'] ?? 0;
        
//     } catch (PDOException $e) {
//         // Utiliser des valeurs par défaut en cas d'erreur
//         $doctors_count = 12;
//         $services_count = 8;
//     }
// } else {
//     // Valeurs par défaut si pas de connexion DB
//     $doctors_count = 12;
//     $services_count = 8;
// }
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>À Propos de Notre Clinique</h1>
            <p>Découvrez notre histoire, nos valeurs et notre engagement pour votre santé</p>
        </div>
    </section>

    <!-- Section Histoire -->
    <section class="about-history">
        <div class="container">
            <div class="history-content">
                <div class="history-text">
                    <h2>Notre Histoire</h2>
                    <p>Fondée en 2005, la <strong>Clinique Médicale</strong> s'est imposée comme une référence dans le paysage médical français. Notre établissement est né d'une vision simple mais ambitieuse : offrir des soins médicaux de qualité accessibles à tous.</p>
                    
                    <p>Depuis nos débuts modestes avec une équipe de 3 médecins, nous n'avons cessé de grandir et de nous moderniser. Aujourd'hui, nous comptons plus de <strong><?php echo $doctors_count; ?> professionnels de santé</strong> et proposons <strong><?php echo $services_count; ?> spécialités médicales</strong>.</p>
                    
                    <p>Notre clinique a su évoluer avec son temps en intégrant les dernières technologies médicales tout en conservant les valeurs humaines qui font notre réputation : écoute, respect et qualité des soins.</p>
                    
                    <div class="history-milestones">
                        <div class="milestone">
                            <div class="year">2005</div>
                            <div class="event">Fondation de la clinique</div>
                        </div>
                        <div class="milestone">
                            <div class="year">2010</div>
                            <div class="event">Ouverture du service d'urgences</div>
                        </div>
                        <div class="milestone">
                            <div class="year">2015</div>
                            <div class="event">Certification qualité ISO 9001</div>
                        </div>
                        <div class="milestone">
                            <div class="year">2023</div>
                            <div class="event">Rénovation et équipements high-tech</div>
                        </div>
                    </div>
                </div>
                <div class="history-image">
                    <div class="image-placeholder">
                        <span>🏥</span>
                        <p>Notre établissement</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Statistiques -->
    <section class="about-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $doctors_count; ?>+</div>
                    <div class="stat-label">Médecins Experts</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">18+</div>
                    <div class="stat-label">Ans d'Expérience</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $services_count; ?></div>
                    <div class="stat-label">Spécialités</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50k+</div>
                    <div class="stat-label">Patients Satisfaits</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Valeurs -->
    <section class="about-values">
        <div class="container">
            <h2>Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">❤</div>
                    <h3>Écoute et Empathie</h3>
                    <p>Nous prenons le temps d'écouter chaque patient et de comprendre ses préoccupations pour offrir des soins personnalisés.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">⚡</div>
                    <h3>Innovation Médicale</h3>
                    <p>Nous investissons régulièrement dans les dernières technologies médicales pour des diagnostics précis et des traitements efficaces.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Équipe Pluridisciplinaire</h3>
                    <p>La collaboration entre nos différents spécialistes garantit une prise en charge globale et coordonnée de votre santé.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🛡</div>
                    <h3>Sécurité des Soins</h3>
                    <p>Nous respectons les protocoles les plus stricts pour assurer votre sécurité et la qualité des soins à chaque étape.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌍</div>
                    <h3>Accessibilité</h3>
                    <p>Notre clinique s'engage à rendre les soins de qualité accessibles à tous, sans discrimination.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">📚</div>
                    <h3>Formation Continue</h3>
                    <p>Notre équipe médicale se forme régulièrement aux dernières avancées médicales et techniques.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Équipements -->
    <section class="about-equipment">
        <div class="container">
            <div class="equipment-content">
                <div class="equipment-image">
                    <div class="image-placeholder">
                        <span>🔬</span>
                        <p>Nos équipements modernes</p>
                    </div>
                </div>
                <div class="equipment-text">
                    <h2>Équipements Modernes</h2>
                    <p>Notre clinique dispose d'équipements médicaux de dernière génération pour assurer des diagnostics précis et des traitements efficaces :</p>
                    
                    <ul class="equipment-list">
                        <li>📡 <strong>IRM 3 Tesla</strong> - Imagerie par résonance magnétique haute définition</li>
                        <li>📷 <strong>Scanner 128 barrettes</strong> - Tomodensitométrie rapide et précise</li>
                        <li>💓 <strong>Échographes haute résolution</strong> - Échographie Doppler couleur</li>
                        <li>🔍 <strong>Laboratoire d'analyses</strong> - Biologie médicale certifiée</li>
                        <li>📊 <strong>Salle de monitoring</strong> - Surveillance continue des patients</li>
                        <li>💻 <strong>Dossier patient informatisé</strong> - Suivi médical numérique sécurisé</li>
                    </ul>
                    
                    <p>Tous nos équipements sont régulièrement maintenus et calibrés selon les normes les plus strictes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Certifications -->
    <section class="about-certifications">
        <div class="container">
            <h2>Certifications et Qualité</h2>
            <div class="certifications-grid">
                <div class="certification-card">
                    <div class="cert-icon">🏆</div>
                    <h3>Certification ISO 9001</h3>
                    <p>Notre système de management de la qualité est certifié selon la norme internationale ISO 9001.</p>
                </div>
                <div class="certification-card">
                    <div class="cert-icon">🩺</div>
                    <h3>Agrément Santé</h3>
                    <p>Agréé par les autorités de santé françaises pour l'exercice de la médecine générale et spécialisée.</p>
                </div>
                <div class="certification-card">
                    <div class="cert-icon">💳</div>
                    <h3>Conventionné Secteur 2</h3>
                    <p>Conventionné avec l'Assurance Maladie et la majorité des mutuelles complémentaires.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section CTA -->
    <section class="about-cta">
        <div class="container">
            <div class="cta-content">
                <h2>Prêt à Prendre Soin de Votre Santé ?</h2>
                <p>Rejoignez les milliers de patients qui nous font confiance pour leurs soins médicaux</p>
                <div class="cta-buttons">
                    <a href="appointment.php" class="btn-primary">Prendre Rendez-vous</a>
                    <a href="contact.php" class="btn-secondary">Nous Contacter</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>