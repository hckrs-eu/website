<?php
$ari_param = $_ENV['ARI_PARAM'] ?: '';
$noi_param = $_ENV['NOI_PARAM'] ?: '';

$ari_shown = $ari_param && isset($_GET[$ari_param]);
$noi_shown = $noi_param && isset($_GET[$noi_param]);

$since = new DateTime("2026-10-23");
$now = new DateTime("now");
$diff = $since->diff($now);

$counter = "";

if ($diff->y > 0) {
  $counter .= strval($diff->y);
  if ($diff->y == 1) $counter .= " year";
  else $counter .= " years";
}
if ($diff->m > 0) {
  if ($counter) $counter .= ", ";
  $counter .= strval($diff->m);
  if ($diff->m == 1) $counter .= " month";
  else $counter .= " months";
}
if ($diff->d > 0) {
  if ($counter) $counter .= " and ";
  $counter .= strval($diff->d);
  if ($diff->d == 1) $counter .= " day";
  else $counter .= " days";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>hckrs.eu</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="container">
      <h1>hckrs.eu</h1>
      <p><del style="text-decoration-thickness: 3px; color: #999;">gay</del> straight furry hackers</p>

      <h2>who we are</h2>
      <p>we are a cute lil couple that likes to goof around and play ctfs together. we're both players
        for our countries at <a href="https://ecsc.eu" target="_blank">ECSC</a>, which is also where we met.</p>

      <h3>ari</h3>
      <p <?php if ($ari_shown) { ?>
        id="<?=$ari_param?>" data-<?=$ari_param?>="<?=htmlspecialchars($_ENV['ARI_CIPHERTEXT']?:'',ENT_QUOTES,'UTF-8')?>"
      <?php } ?>>
        i'm a very smart and beautiful irish kitty girl. my primary ctf categories are forensics and misc.
        i also enjoy music, programming and photographing.
      </p>
      <div class="member-link">
        <a href="https://ahree.xyz">here you can learn about me more:
          <img src="/assets/img/buttons/ari.png"/>
        </a>
      </div>

      <h3>noi</h3>
      <p <?php if ($noi_shown) { ?>
        id="<?=$noi_param?>" data-<?=$noi_param?>="<?=htmlspecialchars($_ENV['NOI_CIPHERTEXT']?:'',ENT_QUOTES,'UTF-8')?>"
      <?php } ?>>
        a slovak larper protogen thing. linux sysadmin alongside being a student. regarding ctfs,
        my primary category is web. i enjoy setting up systems in a declarative manner (sometimes).
        i use primarily ansible and kubernetes for that. i also code sometimes, my fav language is go,
        but i also use python, js/ts, php (yes, i love php) and i want to learn rust or zig.
      </p>
      <div class="member-link">
        <a href="/~noi">here you can learn about me more:
          <img src="/assets/img/buttons/noi.png"/>
        </a>
      </div>

      <h3>it's been</h3>
      <h2 class="counter"><?=$counter?></h2>
      <h3 class="counter-tagline">already!</h3>

      <h2>socials</h2>
      <p class="socials">
        <b>email:</b> contact [at] this domain<br/>
        <b>ctftime:</b> <a href="https://ctftime.org/team/457186" target="_blank">hckrs</a>
      </p>

      <h3>we also report malicious ips for fun</h3>
      <a href="https://www.abuseipdb.com/user/369183" title="AbuseIPDB is an IP address blacklist for webmasters and sysadmins to report IP addresses engaging in abusive behavior on their networks">
        <img class="badge" src="https://www.abuseipdb.com/contributor/369183.svg?theme=dark" alt="AbuseIPDB Contributor Badge">
      </a>
    </div>

    <?= $ari_shown || $noi_shown ? '<script src="assets/js/a7a67479d6bb32.js"></script>' : '' ?>
  </body>
</html>
