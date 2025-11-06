<?php
include 'includes/header.php';
include 'includes/db.php';

// $message = '';
// $message_type = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $patient_name = $_POST['patient_name'];
//     $patient_email = $_POST['patient_email'];
//     $patient_phone = $_POST['patient_phone'];
//     $doctor_id = $_POST['doctor_id'];
//     $appointment_date = $_POST['appointment_date'];
//     $appointment_time = $_POST['appointment_time'];
//     $message_text = $_POST['message'];
    
//     try {
//         $stmt = $pdo->prepare("INSERT INTO appointments (patient_name, patient_email, patient_phone, doctor_id, appointment_date, appointment_time, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
//         $stmt->execute([$patient_name, $patient_email, $patient_phone, $doctor_id, $appointment_date, $appointment_time, $message_text]);
        
//         $message = "Votre demande de rendez-vous a été envoyée avec succès. Nous vous contacterons bientôt pour confirmation.";
//         $message_type = "success";
//     } catch (PDOException $e) {
//         $message = "Une erreur s'est produite lors de l'envoi de votre demande. Veuillez réessayer.";
//         $message_type = "error";
//     }
// }

// $doctors = $pdo->query("SELECT * FROM doctors")->fetchAll(PDO::FETCH_ASSOC);
// ?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Prendre rendez-vous</h1>
            <p>Réservez votre consultation en ligne facilement et rapidement</p>
        </div>
    </section>

    <section class="appointment-form-section">
        <div class="container">
            <!-- <?php if ($message): ?>
                <div class="message <?php echo $message_type; ?>"><?php echo $message; ?></div>
            <?php endif; ?> -->
            
            <form method="POST" class="appointment-form">
                <div class="form-group">
                    <label for="patient_name">Nom complet *</label>
                    <input type="text" id="patient_name" name="patient_name" required>
                </div>
                
                <div class="form-group">
                    <label for="patient_email">Email *</label>
                    <input type="email" id="patient_email" name="patient_email" required>
                </div>
                
                <div class="form-group">
                    <label for="patient_phone">Téléphone *</label>
                    <input type="tel" id="patient_phone" name="patient_phone" required>
                </div>
                
                <div class="form-group">
                    <label for="photo">Photo *</label>
                    <input type="file" name="photo" id="photo" accept="image/*" required placeholder="Choisir une photo">
                </div>

                
                <div class="form-group">
                    <label for="doctor_id">Médecin</label>
                    <select id="doctor_id" name="doctor_id">
                        <option value="">Sélectionnez un médecin (optionnel)
                           <option value="">Chirugien</option> 
                           <option value="">Dentiste</option> 
                           <option value="">Pediatre</option> 
                           <option value="">Gynécologue/obstétricien</option> 
                           <option value="">Psychiatre</option> 
                           <option value="">Dermatologue</option> 
                           <option value="">Neurologue</option> 
                           <option value="">Cardiologue</option> 
                           <option value="">Urgentiste</option> 
                           <option value="">Ophtalmologue</option> 
                           <option value="">Néphrologue</option> 
                        </option>
                        <?php foreach($doctors as $doctor): ?>
                            <option value="<?php echo $doctor['id']; ?>">Dr. <?php echo htmlspecialchars($doctor['name']); ?> - <?php echo htmlspecialchars($doctor['specialty']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="appointment_date">Date souhaitée *</label>
                        <input type="date" id="appointment_date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="appointment_time">Heure souhaitée *</label>
                        <input type="time" id="appointment_time" name="appointment_time" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message">Message (optionnel)</label>
                    <textarea id="message" name="message" rows="5"></textarea>
                </div>
                
                <button type="submit" class="btn-primary">Envoyer la demande</button>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>