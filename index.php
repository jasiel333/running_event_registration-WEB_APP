<?php include 'includes/db.php'; ?>
<?php
$total_query = "SELECT COUNT(*) as total FROM participants";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_participants = $total_row['total'];

$cat_query = "SELECT c.category_name, COUNT(r.registration_id) as count
              FROM categories c
              LEFT JOIN registrations r ON c.category_id = r.category_id
              GROUP BY c.category_id";
$cat_result = mysqli_query($conn, $cat_query);
$cat_counts = [];
while ($row = mysqli_fetch_assoc($cat_result)) {
    $cat_counts[$row['category_name']] = $row['count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-Festival Invitational Run 2026<</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&family=Barlow+Condensed:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ── EVENT LAYOUT ── */
        .event-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 0;
            max-width: 1200px;
            margin: 0 auto;
            align-items: start;
            padding: 0 5% 80px;
        }

        /* ── LEFT CONTENT ── */
        .event-body {
            padding: 50px 50px 50px 0;
            border-right: 1px solid var(--border);
        }

        .event-body h2 {
            font-size: 30px;
            font-weight: 700;
            margin: 36px 0 14px;
            color: var(--text);
        }

        .event-body p {
            font-size: 16px;
            color: var(--text2);
            line-height: 1.85;
            margin-bottom: 16px;
        }

        .event-body ul {
            margin: 12px 0 20px 20px;
            color: var(--text2);
            font-size: 16px;
            line-height: 2.2;
        }

        .event-body ul li {
            font-weight: 600;
            color: var(--text);
        }

        /* HOW TO REGISTER */
        .how-to-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 15px;
            color: var(--text2);
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .how-to-item .check {
            color: #16a34a;
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .how-to-item strong { color: var(--text); }

        /* FAQ CARDS */
        .faq-card {
            border-left: 4px solid var(--accent);
            padding: 16px 20px;
            margin-bottom: 12px;
            background: var(--surface);
            border-radius: 0 12px 12px 0;
            box-shadow: var(--shadow-sm);
            border-top: 1px solid var(--border);
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .faq-card .faq-q {
            font-weight: 700;
            font-size: 15px;
            color: var(--text);
            margin-bottom: 6px;
        }

        .faq-card .faq-a {
            font-size: 14px;
            color: var(--text2);
            line-height: 1.7;
        }

        /* ── TICKET WIDGET (RIGHT) ── */
        .ticket-widget {
            position: sticky;
            top: 70px;
            padding: 28px 24px;
            background: var(--surface);
            border-left: 1px solid var(--border);
            min-height: calc(100vh - 70px);
            box-shadow: -4px 0 20px rgba(0,0,0,0.05);
        }

        .ticket-widget-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        .ticket-row {
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 12px;
            background: var(--bg3);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .ticket-row:hover {
            border-color: rgba(124,58,237,0.3);
            box-shadow: var(--shadow-sm);
        }

        .ticket-row-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .ticket-row-name.c21 { color: var(--accent4); }
        .ticket-row-name.c10 { color: var(--accent5); }
        .ticket-row-name.c5  { color: var(--accent6); }

        .ticket-row-deadline {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 14px;
        }

        .ticket-row-divider {
            border: none;
            border-top: 1px dashed var(--border);
            margin-bottom: 12px;
        }

        .ticket-row-controls {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 8px;
            align-items: center;
        }

        .ticket-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 5px;
        }

        .ticket-price-val {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
        }

        .ticket-subtotal-val {
            font-size: 17px;
            font-weight: 700;
            text-align: right;
            color: var(--text);
        }

        /* QTY CONTROL */
        .qty-control {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            background: var(--surface);
        }

        .qty-btn {
            width: 34px;
            height: 36px;
            background: var(--bg3);
            border: none;
            color: var(--text);
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 400;
            transition: background 0.15s;
            line-height: 1;
        }

        .qty-btn:hover { background: var(--gray2); }

        .qty-val {
            width: 40px;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            background: var(--surface);
            border: none;
            color: var(--text);
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            padding: 0;
            height: 36px;
            line-height: 36px;
        }

        /* TOTALS ROW */
        .ticket-totals {
            border-top: 1.5px solid var(--border);
            padding-top: 16px;
            margin-top: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            margin-bottom: 16px;
        }

        .ticket-totals .total-label {
            color: var(--text2);
            font-weight: 600;
            font-size: 14px;
        }

        .ticket-totals .total-val {
            font-size: 22px;
            font-weight: 700;
            color: var(--accent);
        }

        /* CHECKOUT BUTTON */
        .btn-checkout {
            display: block;
            width: 100%;
            padding: 15px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 14px rgba(124,58,237,0.3);
            font-family: 'Inter', sans-serif;
        }

        .btn-checkout:hover { background: var(--accent2); transform: translateY(-1px); }

        .btn-checkout:disabled {
            background: var(--gray2);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            color: #fff;
        }

        .checkout-note {
            font-size: 12px;
            color: var(--gray);
            text-align: center;
            margin-top: 10px;
            line-height: 1.6;
        }

        /* CATEGORY ROWS on left side */
        .cat-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 12px;
            transition: box-shadow 0.2s, border-color 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .cat-row:hover {
            box-shadow: var(--shadow);
            border-color: rgba(124,58,237,0.2);
        }

        .cat-register-btn {
            display: inline-block;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
            color: #fff;
        }

        .cat-register-btn:hover { opacity: 0.88; transform: translateY(-1px); }

        @media (max-width: 900px) {
            .event-layout { grid-template-columns: 1fr; }
            .event-body { border-right: none; padding: 40px 0; }
            .ticket-widget {
                position: static;
                border-left: none;
                border-top: 1px solid var(--border);
                padding: 30px 0;
                box-shadow: none;
                min-height: unset;
            }
        }
    </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-gradient"></div>
    <div class="hero-content">
        <div class="hero-badge">Registration Open — June 4, 2026</div>
        <h1>
            IT-FEST<br>
            <span>INVITATIONAL</span><br>
             RUN 2026
        </h1>
        <div class="hero-meta">
            <div class="meta-item">
                <div class="meta-icon">📅</div>
                <div>
                    <div style="font-weight:600;color:#fff;">June 5, 2026</div>
                    <div style="font-size:13px;color:#888;">Race Day</div>
                </div>
            </div>
            <div class="meta-item">
                <div class="meta-icon">📍</div>
                <div>
                    <div style="font-weight:600;color:#fff;">NBSC Manolo Fortich, Bukidnon</div>
                    <div style="font-size:13px;color:#888;">Starting Point</div>
                </div>
            </div>
            <div class="meta-item">
                <div class="meta-icon">🧑‍💻</div>
                <div>
                    <div style="font-weight:600;color:#fff;">IT-FESTIVAL</div>
                    <div style="font-size:13px;color:#888;">Celebration Run</div>
                </div>
            </div>
        </div>
        <div class="hero-cta">
            <a href="#tickets" class="btn btn-primary">Get Your Slot →</a>
            <a href="participants.php" class="btn btn-outline">View Participants</a>
        </div>
    </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="stat-item">
        <div class="stat-num"><?php echo $total_participants; ?></div>
        <div class="stat-label">Registered Runners</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">3</div>
        <div class="stat-label">Race Categories</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">21KM</div>
        <div class="stat-label">Longest Distance</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">June 5</div>
        <div class="stat-label">Race Date 2026</div>
    </div>
</div>

<!-- MAIN EVENT LAYOUT -->
<div id="tickets" class="event-layout">

    <!-- LEFT: EVENT BODY -->
    <div class="event-body">

        <h2>About the Event</h2>

        <p>
            In celebration of the <strong style="color:var(--text);">IT Festival 2026</strong>, the Institute of Computer Studies
            proudly presents the <strong style="color:var(--text);">IT Festival Invitational Run 2026</strong>. This event is open to all students,
            faculty, alumni, and running enthusiasts of all fitness levels. The activity aims to promote physical fitness, camaraderie, sportsmanship,
            and a healthy lifestyle while celebrating unity and excellence within the IT community.
        </p>

        <img
            src="https://images.unsplash.com/photo-1571008887538-b36bb32f4571?q=80&w=1200"
            alt="Runners on trail"
            class="about-img">

        <h2>Race Categories</h2>

        <ul>
            <li>5KM — ₱400</li>
            <li>10KM — ₱550</li>
            <li>21KM — ₱700</li>
        </ul>

        <p>Join us on <strong style="color:var(--text);">JUNE 5, 2026</strong>, at NBSC Manolo Fortich, Bukidnon for an unforgettable running experience!</p>

        <h2>How to Register:</h2>

        <div class="how-to-item">
            <span class="check">✅</span>
            <span><strong>Choose Your KM Run:</strong> Select the distance that suits you from the ticket panel on the right.</span>
        </div>
        <div class="how-to-item">
            <span class="check">✅</span>
            <span><strong>Fill Out the Form:</strong> Provide your personal and emergency contact details.</span>
        </div>
        <div class="how-to-item">
            <span class="check">✅</span>
            <span><strong>Pay to Secure Your Spot:</strong> Confirm your registration with payment on race day.</span>
        </div>

        <h2>Frequently Asked Questions</h2>

        <?php
        $faqs = [
            ['q' => 'What does the registration fee include?',
             'a' => 'Race bib, finisher medal, event shirt, and timing chip.'],
            ['q' => 'Is there a cut-off time?',
             'a' => 'Yes. Cut-off times per category will be released closer to race day.'],
            ['q' => 'Can I transfer my registration?',
             'a' => 'Transfers are allowed up to 2 weeks before the event. Contact the organizers.'],
            ['q' => 'What should I bring on race day?',
             'a' => 'Valid ID, your race bib, hydration pack, and a positive attitude!'],
        ];
        foreach ($faqs as $faq): ?>
        <div style="border-left:3px solid var(--accent);padding:14px 20px;margin-bottom:14px;background:var(--surface);border-radius:0 10px 10px 0;box-shadow:var(--shadow-sm);">
            <div style="font-weight:700;font-size:15px;margin-bottom:6px;color:var(--text);"><?php echo $faq['q']; ?></div>
            <div style="font-size:14px;color:var(--text2);line-height:1.7;"><?php echo $faq['a']; ?></div>
        </div>
        <?php endforeach; ?>

    </div>

    <!-- RIGHT: TICKET WIDGET -->
    <div class="ticket-widget">

        <div class="ticket-widget-title">Select Your Category</div>

        <?php
        $ticket_cats = [
            ['name'=>'21KM','price'=>700,'class'=>'c21','deadline'=>'May 30, 2026 at 11:55 pm'],
            ['name'=>'10KM','price'=>550,'class'=>'c10','deadline'=>'May 30, 2026 at 11:55 pm'],
            ['name'=>'5KM', 'price'=>400,'class'=>'c5', 'deadline'=>'May 30, 2026 at 11:55 pm'],
        ];
        foreach ($ticket_cats as $tc):
        ?>
        <div class="ticket-row" id="row-<?php echo $tc['name']; ?>">

            <div class="ticket-row-name <?php echo $tc['class']; ?>"><?php echo $tc['name']; ?></div>
            <div class="ticket-row-deadline">Sale ends on: <?php echo $tc['deadline']; ?></div>

            <hr class="ticket-row-divider">

            <div class="ticket-row-controls">
                <!-- Price -->
                <div>
                    <div class="ticket-label">Ticket Price</div>
                    <div class="ticket-price-val">₱<?php echo number_format($tc['price']); ?>.00</div>
                </div>

                <!-- Qty -->
                <div style="text-align:center;">
                    <div class="ticket-label" style="text-align:center;">Quantity</div>
                    <div class="qty-control">
                        <button class="qty-btn" onclick="changeQty('<?php echo $tc['name']; ?>', -1)">−</button>
                        <div class="qty-val" id="qty-<?php echo $tc['name']; ?>">0</div>
                        <button class="qty-btn" onclick="changeQty('<?php echo $tc['name']; ?>', 1)">+</button>
                    </div>
                </div>

                <!-- Subtotal -->
                <div style="text-align:right;">
                    <div class="ticket-label" style="text-align:right;">Subtotal</div>
                    <div class="ticket-subtotal-val" id="sub-<?php echo $tc['name']; ?>">₱0.00</div>
                </div>
            </div>

        </div>
        <?php endforeach; ?>

        <!-- TOTALS -->
        <div class="ticket-totals">
            <span class="total-label">Quantity: <span id="total-qty">0</span></span>
            <span class="total-val">Total: ₱<span id="grand-total">0.00</span></span>
        </div>

        <!-- CHECKOUT BUTTON -->
        <button class="btn-checkout" id="checkout-btn" disabled onclick="goToRegister()">
            Register Now
        </button>

        <p class="checkout-note">
            Select a category above, then click Register to fill out your details.
        </p>

    </div>

</div>

<?php include 'includes/footer.php'; ?>

<script>
const prices = { '21KM': 700, '10KM': 550, '5KM': 400 };
const qtys   = { '21KM': 0,   '10KM': 0,   '5KM': 0   };
let selectedCat = '';

function changeQty(cat, delta) {
    qtys[cat] = Math.max(0, Math.min(1, qtys[cat] + delta)); // max 1 per category
    updateDisplay();
    selectedCat = cat;
}

function updateDisplay() {
    let totalQty = 0, grandTotal = 0;
    for (const cat in qtys) {
        const q = qtys[cat];
        const sub = q * prices[cat];
        document.getElementById('qty-' + cat).textContent = q;
        document.getElementById('sub-' + cat).textContent = '₱' + sub.toFixed(2);
        document.getElementById('row-' + cat).style.borderColor =
            q > 0 ? 'rgba(124,58,237,0.35)' : '';
        totalQty += q;
        grandTotal += sub;
    }
    document.getElementById('total-qty').textContent = totalQty;
    document.getElementById('grand-total').textContent = grandTotal.toFixed(2);

    const btn = document.getElementById('checkout-btn');
    btn.disabled = totalQty === 0;

    // Figure out which category is selected
    for (const cat in qtys) {
        if (qtys[cat] > 0) selectedCat = cat;
    }
}

function goToRegister() {
    if (selectedCat) {
        window.location.href = 'register.php?category=' + encodeURIComponent(selectedCat);
    }
}
</script>

</body>
</html>