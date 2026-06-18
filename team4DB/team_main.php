<?php
/**
 * Team Main Page - links to each team member's menus
 *
 * This file uses the config.php and validate_session.php you already have in your
 * team folder. It includes robust relative-path fallbacks so it works whether this
 * file is placed at the same level as config.php/validate_session.php or inside a
 * small subfolder. Adjust the $links array below if you want to add/remove items.
 *
 * Place this file in your Team4 folder (e.g. team4DB/) next to config.php and validate_session.php.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Resolve include paths relative to this file (__DIR__)
$configPath = __DIR__ . '/config.php';
$validatePath = __DIR__ . '/validate_session.php';

// Provide common fallbacks (parent directory)
if (!file_exists($configPath) && file_exists(__DIR__ . '/../config.php')) {
    $configPath = __DIR__ . '/../config.php';
}
if (!file_exists($validatePath) && file_exists(__DIR__ . '/../validate_session.php')) {
    $validatePath = __DIR__ . '/../validate_session.php';
}

// Include config and session validator
require_once $configPath;
require_once $validatePath;

// Links to team members' menus (edit to update URLs)
$links = [
    [
        'url' => 'https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/mxrioslozan/DB4342_PhP_mxrioslozan/itemsCode/item_menu.php',
        'title' => 'Items Menu',
        'icon' => '&#128203;'
    ],
    [
        'url' => 'https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/apandey2/DB4342_PhP_apandey2/suppliersCode/supplier_menu.php',
        'title' => 'Supplier Menu',
        'icon' => '&#127981;'
    ],
    [
        'url' => 'https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/ldgarcia13/DB4342_PhP_ldgarcia13/studentsCode/staff_menu.php',
        'title' => 'Staff Menu',
        'icon' => '&#128101;'
    ],
    [
        'url' => 'https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/lzepedarodrig/DB4342_PhP_lzepedarodrig/branchCode/branch_menu.php',
        'title' => 'Branch Menu',
        'icon' => '&#127970;'
    ],
];

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Team 4 Main Menu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #F5E6D3 0%, #FFD7BA 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #8B6F47;
      padding: 40px 0;
    }
    .menu-container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
    h1 { 
      color: #8B6F47; 
      text-align:center; 
      margin-bottom:30px; 
      font-weight:600; 
      letter-spacing: 0.5px;
    }
    .card {
      background: rgba(255,255,255,0.95);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 40px rgba(139, 111, 71, 0.15);
    }
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 16px;
      margin-top: 12px;
    }
    .team-link {
      display:flex;
      align-items:center;
      gap:12px;
      padding:18px;
      border-radius:12px;
      text-decoration:none;
      color:white;
      background: linear-gradient(135deg, #D4A574 0%, #C8956A 100%);
      font-weight:600;
      justify-content:center;
      box-shadow:0 6px 18px rgba(139, 111, 71, 0.2);
      transition: transform .12s ease, box-shadow .12s ease;
    }
    .team-link:hover { 
      transform: translateY(-4px); 
      box-shadow:0 12px 28px rgba(139, 111, 71, 0.3);
      background: linear-gradient(135deg, #C8956A 0%, #B8855A 100%);
    }
    .team-icon { 
      font-size: 24px;
      margin-right: 10px;
      display: inline-block;
      vertical-align: middle;
    }
    .team-label { text-align:left; display:block; }
    .subtext { 
      font-weight:400; 
      font-size:13px; 
      opacity:0.92; 
      display:block; 
      margin-top:4px; 
      color:rgba(255,255,255,0.95); 
    }
    .disabled-link {
      background: linear-gradient(135deg, #E8D5C4 0%, #D4C4B0 100%);
      color: #8B6F47;
      cursor:default;
      pointer-events:none;
      opacity:0.9;
    }
    .disabled-link .subtext {
      color: rgba(139, 111, 71, 0.8);
    }
    .back-link { text-align:center; margin-top:18px; }
    .back-link a { 
      color: #8B6F47; 
      text-decoration:none; 
      font-weight:600; 
      padding:10px 18px; 
      background:rgba(255,255,255,0.9); 
      border-radius:8px; 
      display:inline-block;
      transition: all 0.3s ease;
    }
    .back-link a:hover {
      background: white;
      box-shadow: 0 4px 12px rgba(139, 111, 71, 0.2);
    }
    p {
      color: #8B6F47;
    }
    @media (max-width:420px){
      .team-label { font-size:14px; }
      .subtext { font-size:12px; }
    }
  </style>
</head>
<body>
  <div class="menu-container">
    <h1>Team 4 - Main Menu</h1>
    <div class="card">
      <p style="margin:0 0 8px 0; color:#8B6F47;">Quick links to each member's module. Click a card to open that member's menu in a new tab.</p>

      <div class="team-grid">
        <?php foreach ($links as $l): ?>
          <?php if (!empty($l['url'])): ?>
            <a class="team-link" href="<?php echo htmlspecialchars($l['url']); ?>" target="_blank" rel="noopener">
              <span class="team-icon"><?php echo $l['icon']; ?></span>
              <span class="team-label"><?php echo htmlspecialchars($l['title']); ?>
                <span class="subtext"><?php echo htmlspecialchars($l['subtitle']); ?></span>
              </span>
            </a>
          <?php else: ?>
            <div class="team-link disabled-link" title="Add a URL to enable">
              <span class="team-icon"><?php echo $l['icon']; ?></span>
              <span class="team-label"><?php echo htmlspecialchars($l['title']); ?>
                <span class="subtext"><?php echo htmlspecialchars($l['subtitle']); ?></span>
              </span>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <div class="back-link">
        <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/">Back to Site Home</a>
      </div>
    </div>
  </div>

  <script>
    /**
     * Helper to enable the branch card dynamically from the browser console:
     * enableBranch('https://example.com/branch_menu.php');
     */
    function enableBranch(url) {
      const card = document.querySelector('.disabled-link');
      if (!card || !url) return;
      const a = document.createElement('a');
      a.className = 'team-link';
      a.href = url;
      a.target = '_blank';
      a.rel = 'noopener';
      a.innerHTML = card.innerHTML.replace('(no link yet) � add URL to team_main.php', 'Branch Menu');
      card.parentNode.replaceChild(a, card);
    }
  </script>
</body>
</html>