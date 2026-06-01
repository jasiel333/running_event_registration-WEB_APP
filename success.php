<?php
$rid  = isset($_GET['rid'])  ? intval($_GET['rid'])            : 0;
$pid  = isset($_GET['pid'])  ? intval($_GET['pid'])            : 0;
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Runner';
$cat  = isset($_GET['cat'])  ? htmlspecialchars($_GET['cat'])  : '';
$bib  = isset($_GET['bib'])  ? htmlspecialchars($_GET['bib'])  : '??-000';

$colors  = ['21KM'=>'#ef4444','10KM'=>'#f97316','5KM'=>'#0ea5e9'];
$color   = $colors[$cat] ?? '#7c3aed';
$prices  = ['21KM'=>'700','10KM'=>'550','5KM'=>'400'];
$price   = $prices[$cat] ?? '—';
$firstname = strtoupper(explode(' ', trim($name))[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmed — Banog-Banog Run 2026</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        .success-page {
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }

        .success-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px 36px;
            max-width: 480px;
            width: 100%;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        /* CHECK ICON */
        .check-icon {
            width: 64px;
            height: 64px;
            background: rgba(124,58,237,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 16px;
        }

        /* LABEL */
        .confirmed-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 8px;
        }

        /* HEADING */
        .success-heading {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 52px;
            letter-spacing: 2px;
            line-height: 1;
            color: var(--text);
            margin-bottom: 10px;
        }

        /* SUBTITLE */
        .success-sub {
            font-size: 14px;
            color: var(--text2);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* BIB CARD */
        .bib-card {
            background: var(--bg3);
            border: 2px solid <?php echo $color; ?>;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 16px;
            position: relative;
            overflow: hidden;
        }

        .bib-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: <?php echo $color; ?>;
        }

        .bib-top-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 4px;
        }

        .bib-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 60px;
            letter-spacing: 4px;
            color: <?php echo $color; ?>;
            line-height: 1;
        }

        .bib-event {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: var(--gray);
            text-transform: uppercase;
            margin-top: 4px;
        }

        .bib-runner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--border);
        }

        .bib-runner-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            text-align: left;
        }

        .bib-cat-badge {
            background: <?php echo $color; ?>;
            color: #fff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            letter-spacing: 2px;
            padding: 4px 14px;
            border-radius: 6px;
        }

        /* INFO GRID */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
        }

        .info-box {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            text-align: left;
        }

        .info-box .ib-label {
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 4px;
            font-weight: 600;
        }

        .info-box .ib-val {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        /* NEXT STEPS */
        .next-steps {
            background: rgba(124,58,237,0.05);
            border: 1px solid rgba(124,58,237,0.18);
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 16px;
            text-align: left;
        }

        .next-steps h3 {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .next-step-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: var(--text2);
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .next-step-item:last-child { margin-bottom: 0; }

        .step-num {
            width: 20px; height: 20px; min-width: 20px;
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1px;
        }

        .next-step-item strong { color: var(--text); }

        /* BUTTONS */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .suc-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 13px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .suc-btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(124,58,237,0.3);
        }

        .suc-btn-primary:hover { background: var(--accent2); transform: translateY(-1px); }

        .suc-btn-outline {
            background: var(--bg3);
            color: var(--text);
            border: 1.5px solid var(--border);
        }

        .suc-btn-outline:hover { border-color: rgba(124,58,237,0.4); color: var(--accent); }
    </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="success-page">
    <div class="success-card">

        <!-- ICON -->
        <div class="check-icon">✅</div>

        <!-- LABEL + HEADING -->
        <div class="confirmed-label">Registration Confirmed</div>
        <div class="success-heading">YOU'RE IN,<br><?php echo $firstname; ?>!</div>

        <!-- SUBTITLE -->
        <p class="success-sub">
            Your registration for the <strong style="color:var(--text);">Banog-Banog Mixed Terrain Invitational Run 2026</strong> has been confirmed.
        </p>

        <!-- BIB CARD -->
        <div class="bib-card">
            <div class="bib-top-label">Race Bib Number</div>
            <div class="bib-number"><?php echo $bib; ?></div>
            <div class="bib-event">Banog-Banog Invitational Run 2026</div>
            <div class="bib-runner">
                <div class="bib-runner-name"><?php echo htmlspecialchars($name); ?></div>
                <div class="bib-cat-badge"><?php echo $cat; ?></div>
            </div>
        </div>

        <!-- INFO GRID -->
        <div class="info-grid">
            <div class="info-box">
                <div class="ib-label">Race Date</div>
                <div class="ib-val">📅 June 6, 2026</div>
            </div>
            <div class="info-box">
                <div class="ib-label">Location</div>
                <div class="ib-val">📍 Manolo Fortich</div>
            </div>
            <div class="info-box">
                <div class="ib-label">Category</div>
                <div class="ib-val" style="color:<?php echo $color; ?>;"><?php echo $cat; ?></div>
            </div>
            <div class="info-box">
                <div class="ib-label">Registration Fee</div>
                <div class="ib-val">₱<?php echo $price; ?></div>
            </div>
        </div>

        <!-- NEXT STEPS -->
        <div class="next-steps">
            <h3>What's Next?</h3>
            <div class="next-step-item">
                <div class="step-num">1</div>
                <span><strong>Screenshot your bib</strong> — present this on race day check-in.</span>
            </div>
            <div class="next-step-item">
                <div class="step-num">2</div>
                <span><strong>Prepare ₱<?php echo $price; ?></strong> payment to be settled on race day.</span>
            </div>
            <div class="next-step-item">
                <div class="step-num">3</div>
                <span><strong>Arrive early</strong> on June 6, 2026 at Manolo Fortich.</span>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="btn-group">
            <a href="participants.php" class="suc-btn suc-btn-outline">👥 View All Participants</a>
            <a href="index.php" class="suc-btn suc-btn-primary">Back to Home →</a>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>