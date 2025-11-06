<?php
// Activer l'affichage des erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/header.php';
include 'includes/db.php';

// Variables pour le traitement du formulaire
$message_sent = false;
$error_message = '';
$form_data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et sécurisation des données
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    $message_content = trim($_POST['message']);
    
    // Validation des données
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Le nom est obligatoire";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Une adresse email valide est obligatoire";
    }
    
    if (empty($subject)) {
        $errors[] = "Le sujet est obligatoire";
    }
    
    if (empty($message_content) || strlen($message_content) < 10) {
        $errors[] = "Le message doit contenir au moins 10 caractères";
    }
    
    // Si pas d'erreurs, traitement du formulaire
    if (empty($errors)) {
        try {
            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $name, 
                $email, 
                $phone, 
                $subject, 
                $message_content,
                $_SERVER['REMOTE_ADDR']
            ]);
            
            // Envoi d'email (simulation - à adapter avec votre service d'email)
            $to = "contact@cliniquemedicale.fr";
            $email_subject = "Nouveau message de contact: " . $subject;
            $email_body = "
                Nom: $name\n
                Email: $email\n
                Téléphone: $phone\n
                Sujet: $subject\n\n
                Message:\n$message_content\n\n
                IP: {$_SERVER['REMOTE_ADDR']}\n
                Date: " . date('d/m/Y H:i:s') . "
            ";
            $headers = "From: $email\r\nReply-To: $email\r\n";
            
            // Décommenter pour activer l'envoi d'email
            // mail($to, $email_subject, $email_body, $headers);
            
            $message_sent = true;
            
        } catch (PDOException $e) {
            $error_message = "Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer.";
        }
    } else {
        $error_message = implode("<br>", $errors);
        // Sauvegarder les données pour les réafficher
        $form_data = compact('name', 'email', 'phone', 'subject', 'message_content');
    }
}
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Contactez-nous</h1>
            <p>Notre équipe est à votre écoute pour répondre à toutes vos questions</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <!-- Informations de contact -->
                <div class="contact-info">
                    <h2>Nos Coordonnées</h2>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h3>Adresse</h3>
                            <p>123 Rue de la Santé<br>75000 Paris, France</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-details">
                            <h3>Téléphone</h3>
                            <p>01 23 45 67 89</p>
                            <small>Urgences: 24h/24</small>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">✉</div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>contact@cliniquemedicale.fr</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div class="contact-details">
                            <h3>Horaires d'ouverture</h3>
                            <p>Lun - Ven: 8h00 - 19h00<br>
                               Sam: 9h00 - 17h00<br>
                               Dim: Urgences uniquement</p>
                        </div>
                    </div>

                    <div class="emergency-contact">
                        <h3>🔴 Urgences Médicales</h3>
                        <p>En cas d'urgence, contactez-nous immédiatement au :</p>
                        <p class="emergency-phone">01 23 45 67 89</p>
                        <p>Notre équipe est disponible 24h/24 pour les urgences.</p>
                    </div>
                </div>

                <!-- Formulaire de contact -->
                <div class="contact-form-container">
                    <h2>Envoyez-nous un message</h2>
                    
                    <?php if ($message_sent): ?>
                        <div class="success-message">
                            <h3>✅ Message envoyé avec succès !</h3>
                            <p>Nous vous répondrons dans les plus brefs délais.</p>
                            <a href="contact.php" class="btn-primary">Nouveau message</a>
                        </div>
                    <?php else: ?>
                        <?php if ($error_message): ?>
                            <div class="error-message">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nom complet *</label>
                                    <input type="text" id="name" name="name" 
                                           value="<?php echo htmlspecialchars($form_data['name'] ?? ''); ?>" 
                                           required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" 
                                           value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>" 
                                           required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" id="phone" name="phone" 
                                           value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="subject">Sujet *</label>
                                    <select id="subject" name="subject" required>
                                        <option value="">Choisissez un sujet</option>
                                        <option value="Renseignement" <?php echo (($form_data['subject'] ?? '') == 'Renseignement') ? 'selected' : ''; ?>>Renseignement</option>
                                        <option value="Prise de rendez-vous" <?php echo (($form_data['subject'] ?? '') == 'Prise de rendez-vous') ? 'selected' : ''; ?>>Prise de rendez-vous</option>
                                        <option value="Urgence" <?php echo (($form_data['subject'] ?? '') == 'Urgence') ? 'selected' : ''; ?>>Urgence</option>
                                        <option value="Facturation" <?php echo (($form_data['subject'] ?? '') == 'Facturation') ? 'selected' : ''; ?>>Facturation</option>
                                        <option value="Autre" <?php echo (($form_data['subject'] ?? '') == 'Autre') ? 'selected' : ''; ?>>Autre</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="6" 
                                          placeholder="Décrivez votre demande en détail..." 
                                          required><?php echo htmlspecialchars($form_data['message_content'] ?? ''); ?></textarea>
                            </div>

                            <button type="submit" class="btn-primary btn-large">Envoyer le message</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Carte Google Maps -->
    <section class="map-section">
        <div class="container">
            <h2>Nous trouver</h2>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991625693759!2d2.292292615674389!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1620000000000!5m2!1sfr!2sfr" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                    title="Localisation de la Clinique Médicale">
                </iframe>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>