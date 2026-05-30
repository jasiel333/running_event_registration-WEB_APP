<nav class="navbar">

    <a href="index.php" class="logo">
        RUN <span>WITH</span> JASIEL & JHON
    </a>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="participants.php">Participants</a>
        <a href="#" class="btn-register" onclick="openCategoryModal(); return false;">Register Now</a>
    </div>

</nav>

<!-- CATEGORY PICKER MODAL -->
<div id="categoryModal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:20px; padding:36px 32px; max-width:420px; width:90%; box-shadow:0 20px 60px rgba(0,0,0,0.2); position:relative;">

        <!-- CLOSE -->
        <button onclick="closeCategoryModal()" style="position:absolute; top:16px; right:16px; background:none; border:none; font-size:22px; cursor:pointer; color:#888; line-height:1;">✕</button>

        <!-- TITLE -->
        <div style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#7c3aed; margin-bottom:8px;">Registration</div>
        <div style="font-family:'Bebas Neue',sans-serif; font-size:36px; letter-spacing:1px; color:#111; margin-bottom:6px; line-height:1;">CHOOSE YOUR CATEGORY</div>
        <p style="font-size:14px; color:#666; margin-bottom:24px;">Select the race distance you want to join.</p>

        <!-- CATEGORY OPTIONS -->
        <a href="register.php?category=21KM" style="display:flex; align-items:center; justify-content:space-between; background:#fef2f2; border:1.5px solid #fca5a5; border-radius:12px; padding:16px 20px; margin-bottom:10px; text-decoration:none; transition:all 0.2s;" onmouseover="this.style.borderColor='#ef4444'" onmouseout="this.style.borderColor='#fca5a5'">
            <div>
                <div style="font-family:'Bebas Neue',sans-serif; font-size:28px; color:#ef4444; line-height:1;">21KM</div>
                <div style="font-size:12px; color:#888; margin-top:2px;">Elite · Mixed Terrain</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:20px; font-weight:700; color:#111;">₱700</div>
                <div style="font-size:11px; font-weight:700; background:#ef4444; color:#fff; padding:3px 10px; border-radius:4px; margin-top:4px;">ELITE</div>
            </div>
        </a>

        <a href="register.php?category=10KM" style="display:flex; align-items:center; justify-content:space-between; background:#fff7ed; border:1.5px solid #fdba74; border-radius:12px; padding:16px 20px; margin-bottom:10px; text-decoration:none; transition:all 0.2s;" onmouseover="this.style.borderColor='#f97316'" onmouseout="this.style.borderColor='#fdba74'">
            <div>
                <div style="font-family:'Bebas Neue',sans-serif; font-size:28px; color:#f97316; line-height:1;">10KM</div>
                <div style="font-size:12px; color:#888; margin-top:2px;">Popular · Trail Run</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:20px; font-weight:700; color:#111;">₱550</div>
                <div style="font-size:11px; font-weight:700; background:#f97316; color:#fff; padding:3px 10px; border-radius:4px; margin-top:4px;">POPULAR</div>
            </div>
        </a>

        <a href="register.php?category=5KM" style="display:flex; align-items:center; justify-content:space-between; background:#f0f9ff; border:1.5px solid #7dd3fc; border-radius:12px; padding:16px 20px; margin-bottom:0; text-decoration:none; transition:all 0.2s;" onmouseover="this.style.borderColor='#0ea5e9'" onmouseout="this.style.borderColor='#7dd3fc'">
            <div>
                <div style="font-family:'Bebas Neue',sans-serif; font-size:28px; color:#0ea5e9; line-height:1;">5KM</div>
                <div style="font-size:12px; color:#888; margin-top:2px;">Fun Run · All levels</div>
            </div>
            <div style="text-align:right;">
                <div style="font-size:20px; font-weight:700; color:#111;">₱400</div>
                <div style="font-size:11px; font-weight:700; background:#0ea5e9; color:#fff; padding:3px 10px; border-radius:4px; margin-top:4px;">FUN RUN</div>
            </div>
        </a>

    </div>
</div>

<script>
function openCategoryModal() {
    const modal = document.getElementById('categoryModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeCategoryModal() {
    const modal = document.getElementById('categoryModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

// Close when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('categoryModal');
    if (e.target === modal) {
        closeCategoryModal();
    }
});

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeCategoryModal();
});
</script>