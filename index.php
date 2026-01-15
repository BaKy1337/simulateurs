<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulateur DeNormandie</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-blue-deep: #222D52;
            --color-beige-gold: #d2b68a;
            --color-white: #ffffff;
            --color-gray-200: #e9ecef;
            --color-gray-300: #dee2e6;
            --color-text-primary: #222D52;
            --color-text-secondary: #495057;
            --color-text-muted: #868e96;
            --color-success: #10b981;
            
            --space-xs: 2px;
            --space-sm: 4px;
            --space-md: 6px;
            --space-lg: 10px;
            --space-xl: 14px;
            
            --shadow-sm: 0 1px 2px rgba(34, 45, 82, 0.05);
            --shadow-md: 0 2px 4px rgba(34, 45, 82, 0.1);
            --radius-sm: 3px;
            --radius-md: 5px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Lato', sans-serif;
            background: #fafbfc;
            color: var(--color-text-primary);
            line-height: 1.4;
            padding: var(--space-lg);
            font-size: 11px;
        }
        
        .container {
            max-width: 100%;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: var(--space-xl);
            padding: var(--space-md) 0;
        }
        
        .page-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--color-blue-deep);
            margin-bottom: var(--space-xs);
        }
        
        .page-header .subtitle {
            font-size: 0.75rem;
            color: var(--color-text-secondary);
        }
        
        /* Grille principale : Paramètres | Bilan */
        .top-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-xl);
            margin-bottom: var(--space-xl);
            align-items: stretch;
        }
        
        @media (max-width: 900px) {
            .top-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Grille résultats : pleine largeur */
        .results-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: var(--space-xl);
            display: none;
        }
        
        .results-grid.show {
            display: grid;
        }
        
        @media (max-width: 1600px) {
            .results-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 1200px) {
            .results-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 900px) {
            .results-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .card {
            background: var(--color-white);
            border-radius: var(--radius-md);
            padding: var(--space-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-gray-200);
            display: flex;
            flex-direction: column;
        }
        
        .card.hidden {
            display: none;
        }
        
        .card h2 {
            font-family: 'Cinzel', serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--color-blue-deep);
            margin-bottom: var(--space-md);
            padding-bottom: var(--space-sm);
            border-bottom: 2px solid var(--color-beige-gold);
        }
        
        .card h3 {
            font-family: 'Cinzel', serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-blue-deep);
            margin: var(--space-md) 0 var(--space-sm);
        }
        
        .card h3:first-of-type {
            margin-top: 0;
        }
        
        .section-intro {
            background: #f8f9fa;
            padding: var(--space-sm);
            border-radius: var(--radius-sm);
            margin-bottom: var(--space-md);
            font-size: 0.7rem;
            color: var(--color-text-secondary);
            border: 1px solid var(--color-gray-200);
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-md);
        }
        
        .form-group {
            margin-bottom: var(--space-md);
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        label {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--color-text-primary);
            margin-bottom: var(--space-xs);
        }
        
        input, select {
            width: 100%;
            background: var(--color-white);
            border: 1px solid var(--color-gray-300);
            border-radius: var(--radius-sm);
            padding: 4px 8px;
            font-size: 0.75rem;
            font-family: 'Lato', sans-serif;
            color: var(--color-text-primary);
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: var(--color-beige-gold);
            box-shadow: 0 0 0 2px rgba(210, 182, 138, 0.1);
        }
        
        .input-suffix {
            position: relative;
        }
        
        .input-suffix input {
            padding-right: 35px;
        }
        
        .input-suffix::after {
            content: attr(data-suffix);
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-muted);
            font-weight: 500;
            font-size: 0.7rem;
            pointer-events: none;
        }
        
        .button-group {
            display: flex;
            gap: var(--space-md);
            margin-top: var(--space-md);
        }
        
        button {
            flex: 1;
            background: linear-gradient(135deg, var(--color-beige-gold) 0%, #c4a876 100%);
            color: var(--color-blue-deep);
            border: none;
            border-radius: var(--radius-md);
            padding: 8px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
        }
        
        button:hover {
            opacity: 0.9;
        }
        
        button.secondary {
            background: var(--color-gray-200);
            color: var(--color-text-primary);
        }
        
        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3px 0;
            border-bottom: 1px solid var(--color-gray-200);
            font-size: 0.75rem;
        }
        
        .result-row:last-child {
            border-bottom: none;
        }
        
        .result-label {
            color: var(--color-text-secondary);
        }
        
        .result-value {
            font-weight: 600;
            color: var(--color-text-primary);
            text-align: right;
        }
        
        .result-value.positive {
            color: var(--color-success);
            font-weight: 700;
        }
        
        .result-value.highlight {
            color: var(--color-beige-gold);
            font-size: 0.85rem;
            font-weight: 700;
        }
        
        .result-value.big {
            font-size: 1rem;
            font-weight: 700;
            color: var(--color-beige-gold);
            font-family: 'Cinzel', serif;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, var(--color-blue-deep) 0%, #2a3758 100%);
            color: var(--color-white);
            padding: var(--space-md);
            border-radius: var(--radius-md);
            margin: var(--space-md) 0;
            box-shadow: var(--shadow-md);
        }
        
        .highlight-box .result-row {
            border-color: rgba(255, 255, 255, 0.15);
        }
        
        .highlight-box .result-label,
        .highlight-box .result-value {
            color: var(--color-white);
        }
        
        .highlight-box .result-value.big {
            color: var(--color-beige-gold);
        }
        
        .synthese {
            background: #f8f9fa;
            border-radius: var(--radius-md);
            padding: var(--space-md);
            border-left: 2px solid var(--color-beige-gold);
            flex: 1;
        }
        
        .synthese h3 {
            margin-top: 0;
            color: var(--color-blue-deep);
            font-size: 0.85rem;
            margin-bottom: var(--space-sm);
        }
        
        .synthese h4 {
            font-family: 'Cinzel', serif;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--color-blue-deep);
            margin: var(--space-md) 0 var(--space-xs);
        }
        
        .synthese h4:first-of-type {
            margin-top: 0;
        }
        
        .empty-state {
            text-align: center;
            padding: var(--space-xl) var(--space-md);
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .empty-state p {
            font-size: 0.8rem;
            margin-bottom: var(--space-xs);
            color: var(--color-text-primary);
        }
        
        .empty-state p:last-child {
            color: var(--color-text-muted);
            font-size: 0.75rem;
        }
        
        .results-section {
            margin-bottom: var(--space-md);
        }
        
        .results-section h3 {
            margin-bottom: var(--space-sm);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>🏠 Simulateur DeNormandie</h1>
            <p class="subtitle">Simulateur technique</p>
        </div>
        
        <form method="POST" action="" id="simulatorForm">
            <!-- Grille supérieure : Paramètres | Bilan -->
            <div class="top-grid">
                <!-- Colonne 1 : Paramètres -->
                <div class="card" id="paramsCard">
                    <h2>📝 Paramètres</h2>
                    
                    <div class="section-intro">
                        Renseignez les informations du projet immobilier.
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <h3>🏡 Bien immobilier</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="prix_bien">Prix</label>
                            <div class="input-suffix" data-suffix="€">
                                <input type="number" id="prix_bien" name="prix_bien" step="1" 
                                       placeholder="150000" 
                                       value="<?= $_POST['prix_bien'] ?? '' ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="surface">Surface</label>
                            <div class="input-suffix" data-suffix="m²">
                                <input type="number" id="surface" name="surface" step="0.01" 
                                       placeholder="65" 
                                       value="<?= $_POST['surface'] ?? '' ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="plafond_loyer">Plafond</label>
                            <div class="input-suffix" data-suffix="€/m²">
                                <input type="number" id="plafond_loyer" name="plafond_loyer" step="0.01" 
                                       placeholder="10.15" 
                                       value="<?= $_POST['plafond_loyer'] ?? '' ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <h3>💳 Frais</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="frais_garantie">Garantie</label>
                            <div class="input-suffix" data-suffix="€">
                                <input type="number" id="frais_garantie" name="frais_garantie" step="1" 
                                       placeholder="3000" 
                                       value="<?= $_POST['frais_garantie'] ?? '' ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="frais_dossier">Dossier</label>
                            <div class="input-suffix" data-suffix="€">
                                <input type="number" id="frais_dossier" name="frais_dossier" step="1" 
                                       placeholder="500" 
                                       value="<?= $_POST['frais_dossier'] ?? '' ?>">
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <h3>🏦 Prêt</h3>
                        </div>
                        
                        <div class="form-group">
                            <label for="duree">Durée</label>
                            <div class="input-suffix" data-suffix="ans">
                                <input type="number" id="duree" name="duree" min="5" max="30" 
                                       placeholder="25" 
                                       value="<?= $_POST['duree'] ?? '25' ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="taux_emprunt">Taux</label>
                            <div class="input-suffix" data-suffix="%">
                                <input type="number" id="taux_emprunt" name="taux_emprunt" step="0.01" 
                                       placeholder="3.2" 
                                       value="<?= $_POST['taux_emprunt'] ?? '3.2' ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="taux_assurance">Assurance</label>
                            <div class="input-suffix" data-suffix="%">
                                <input type="number" id="taux_assurance" name="taux_assurance" step="0.01" 
                                       placeholder="0.3" 
                                       value="<?= $_POST['taux_assurance'] ?? '0.3' ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <h3>📊 Fiscal</h3>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="tmi">TMI</label>
                            <select id="tmi" name="tmi" required>
                                <option value="" disabled <?= !isset($_POST['tmi']) ? 'selected' : '' ?>>-- Sélectionnez --</option>
                                <option value="11" <?= (isset($_POST['tmi']) && $_POST['tmi'] == 11) ? 'selected' : '' ?>>11%</option>
                                <option value="30" <?= (isset($_POST['tmi']) && $_POST['tmi'] == 30) ? 'selected' : '' ?>>30%</option>
                                <option value="41" <?= (isset($_POST['tmi']) && $_POST['tmi'] == 41) ? 'selected' : '' ?>>41%</option>
                                <option value="45" <?= (isset($_POST['tmi']) && $_POST['tmi'] == 45) ? 'selected' : '' ?>>45%</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit">🔄 Calculer</button>
                        <button type="button" class="secondary" id="resetBtn" style="display: none;">↺ Réinitialiser</button>
                    </div>
                </div>
                
                <!-- Colonne 2 : Bilan -->
                <div class="card hidden" id="bilanCard">
                    <h2>📈 Bilan</h2>
                    
                    <?php
                    $form_submitted = isset($_POST['prix_bien']) && isset($_POST['surface']) && isset($_POST['tmi']) && $_POST['tmi'] !== '';
                    
                    if ($form_submitted):
                        $prix_bien = floatval($_POST['prix_bien']);
                        $frais_garantie = floatval($_POST['frais_garantie'] ?? 0);
                        $frais_dossier = floatval($_POST['frais_dossier'] ?? 0);
                        $duree = intval($_POST['duree']);
                        $taux_emprunt = floatval($_POST['taux_emprunt']);
                        $taux_assurance = floatval($_POST['taux_assurance']);
                        $surface = floatval($_POST['surface']);
                        $plafond_loyer = floatval($_POST['plafond_loyer']);
                        $tmi = intval($_POST['tmi']);
                        
                        $coef_base = 0.7;
                        $coef_numerateur = 19;
                        
                        $frais_notaire = $prix_bien * 0.06;
                        $montant_emprunte = $prix_bien;
                        
                        $taux_mensuel = ($taux_emprunt / 100) / 12;
                        $nb_mensualites = $duree * 12;
                        if ($taux_mensuel > 0) {
                            $mensualite_pret = ($montant_emprunte * $taux_mensuel) / (1 - pow(1 + $taux_mensuel, -$nb_mensualites));
                        } else {
                            $mensualite_pret = $montant_emprunte / $nb_mensualites;
                        }
                        $assurance_mensuelle = $montant_emprunte * ($taux_assurance / 100) / 12;
                        $mensualite_totale = round($mensualite_pret + $assurance_mensuelle, 2);
                        
                        $coef_multiplicateur = $coef_base + ($coef_numerateur / $surface);
                        $coef_multiplicateur = min($coef_multiplicateur, 1.20);
                        
                        $loyer_mensuel = $surface * $plafond_loyer * $coef_multiplicateur;
                        $frais_gestion = $loyer_mensuel * 0.1;
                        $taxe_fonciere = ($loyer_mensuel * 1.2) / 12;
                        $charges_copro = ($surface * 1.5) / 3;
                        $charges_mensuelles = $frais_gestion + $taxe_fonciere + $charges_copro;
                        
                        switch($tmi) {
                            case 11: $pct_applique = 0.718; break;
                            case 30: $pct_applique = 0.528; break;
                            case 41: $pct_applique = 0.418; break;
                            case 45: $pct_applique = 0.378; break;
                            default: $pct_applique = 0.528;
                        }
                        
                        $charges_reelles = $charges_mensuelles * $pct_applique;
                        $reduction_1_6_mois = (($prix_bien + $frais_notaire) * 0.02) / 12;
                        $reduction_6_9_mois = (($prix_bien + $frais_notaire) * 0.02) / 12;
                        $reduction_9_12_mois = (($prix_bien + $frais_notaire) * 0.01) / 12;
                        $revenus_1_9 = $loyer_mensuel + $reduction_1_6_mois;
                        $charges_1_9 = $taux_assurance + $charges_reelles;
                        $effort_1_9 = $revenus_1_9 - $charges_1_9;
                        $revenus_9_12 = $loyer_mensuel + $reduction_9_12_mois;
                        $charges_9_12 = $taux_assurance + $charges_reelles;
                        $effort_9_12 = $revenus_9_12 - $charges_9_12;
                        $economie_fiscale_12ans = 0.21 * ($prix_bien + $frais_notaire);
                        $tri = ($revenus_1_9 * 12) / $prix_bien * 100;
                        
                        function format_euro($val) {
                            return number_format($val, 2, ',', ' ') . ' €';
                        }
                    ?>
                    
                    <div class="synthese">
                        <h3>Années 1-9</h3>
                        <div class="result-row">
                            <span class="result-label">Revenus</span>
                            <span class="result-value positive"><?= format_euro($revenus_1_9) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">Charges</span>
                            <span class="result-value"><?= format_euro($charges_1_9) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label"><strong>Net</strong></span>
                            <span class="result-value highlight"><?= format_euro($effort_1_9) ?></span>
                        </div>
                        
                        <h4>Années 10-12</h4>
                        <div class="result-row">
                            <span class="result-label">Revenus</span>
                            <span class="result-value positive"><?= format_euro($revenus_9_12) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">Charges</span>
                            <span class="result-value"><?= format_euro($charges_9_12) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label"><strong>Net</strong></span>
                            <span class="result-value highlight"><?= format_euro($effort_9_12) ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Grille résultats : pleine largeur -->
            <div class="results-grid <?= $form_submitted ? 'show' : '' ?>" id="resultsGrid">
                <?php if ($form_submitted): ?>
                <!-- Colonne 1 : Économie & TRI -->
                <div class="card">
                    <h2>💰 Économie & TRI</h2>
                    <div class="highlight-box">
                        <div class="result-row">
                            <span class="result-label">Économie (12 ans)</span>
                            <span class="result-value big"><?= format_euro($economie_fiscale_12ans) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">TRI</span>
                            <span class="result-value big"><?= number_format($tri, 2, ',', ' ') ?>%</span>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne 2 : Coûts -->
                <div class="card">
                    <h2>💵 Coûts</h2>
                    <div class="results-section">
                        <div class="result-row">
                            <span class="result-label">Prix</span>
                            <span class="result-value"><?= format_euro($prix_bien) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">Notaire</span>
                            <span class="result-value"><?= format_euro($frais_notaire) ?></span>
                        </div>
                        <?php if ($frais_garantie > 0): ?>
                        <div class="result-row">
                            <span class="result-label">Garantie</span>
                            <span class="result-value"><?= format_euro($frais_garantie) ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ($frais_dossier > 0): ?>
                        <div class="result-row">
                            <span class="result-label">Dossier</span>
                            <span class="result-value"><?= format_euro($frais_dossier) ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="result-row">
                            <span class="result-label"><strong>Emprunté</strong></span>
                            <span class="result-value highlight"><?= format_euro($montant_emprunte) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label"><strong>Mensualité</strong></span>
                            <span class="result-value highlight"><?= format_euro($mensualite_totale) ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne 3 : Revenus -->
                <div class="card">
                    <h2>🏠 Revenus</h2>
                    <div class="results-section">
                        <div class="result-row">
                            <span class="result-label">Coefficient</span>
                            <span class="result-value"><?= number_format($coef_multiplicateur, 2, ',', ' ') ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label"><strong>Loyer mensuel</strong></span>
                            <span class="result-value highlight"><?= format_euro($loyer_mensuel) ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne 4 : Charges -->
                <div class="card">
                    <h2>📋 Charges</h2>
                    <div class="results-section">
                        <div class="result-row">
                            <span class="result-label">Gestion</span>
                            <span class="result-value"><?= format_euro($frais_gestion) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">Foncière</span>
                            <span class="result-value"><?= format_euro($taxe_fonciere) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">Copro</span>
                            <span class="result-value"><?= format_euro($charges_copro) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label"><strong>Total</strong></span>
                            <span class="result-value"><?= format_euro($charges_mensuelles) ?></span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">Réelles (<?= $tmi ?>%)</span>
                            <span class="result-value"><?= format_euro($charges_reelles) ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne 5 : Réductions -->
                <div class="card">
                    <h2>🎯 Réductions</h2>
                    <div class="results-section">
                        <div class="result-row">
                            <span class="result-label">1-6 ans</span>
                            <span class="result-value positive"><?= format_euro($reduction_1_6_mois) ?>/mois</span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">7-9 ans</span>
                            <span class="result-value positive"><?= format_euro($reduction_6_9_mois) ?>/mois</span>
                        </div>
                        <div class="result-row">
                            <span class="result-label">10-12 ans</span>
                            <span class="result-value positive"><?= format_euro($reduction_9_12_mois) ?>/mois</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('simulatorForm');
            const resetBtn = document.getElementById('resetBtn');
            const bilanCard = document.getElementById('bilanCard');
            const resultsGrid = document.getElementById('resultsGrid');
            const formSubmitted = <?= $form_submitted ? 'true' : 'false' ?>;
            
            // Afficher/masquer selon l'état initial
            if (formSubmitted) {
                bilanCard.classList.remove('hidden');
                resultsGrid.classList.add('show');
                resetBtn.style.display = 'block';
            } else {
                bilanCard.classList.add('hidden');
                resultsGrid.classList.remove('show');
                resetBtn.style.display = 'none';
            }
            
            // Gestion du bouton réinitialiser
            resetBtn.addEventListener('click', function() {
                form.reset();
                bilanCard.classList.add('hidden');
                resultsGrid.classList.remove('show');
                resetBtn.style.display = 'none';
                // Recharger la page pour réinitialiser complètement
                window.location.href = window.location.pathname;
            });
            
            // Gestion de la soumission du formulaire
            form.addEventListener('submit', function(e) {
                // Le formulaire se soumet normalement, PHP gère l'affichage
            });
        });
    </script>
</body>
</html>