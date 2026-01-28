<?php
/**
 * WayForPay redirect (PURCHASE) - server-side signature.
 * Put this file next to index.html on your hosting.
 *
 * Official docs: https://wiki.wayforpay.com/en/view/852102
 */
declare(strict_types=1);

// === SET YOUR CREDENTIALS ===
$merchantAccount = 'YOUR_MERCHANT_ACCOUNT';
$merchantSecretKey = 'YOUR_MERCHANT_SECRET_KEY';

// (optional) callback from WayForPay with payment status:
$serviceUrl = ''; // e.g. https://yourdomain.com/wfp-callback.php
// (optional) where to return user after payment:
$returnUrl  = ''; // e.g. https://yourdomain.com/thanks.html

$email   = trim((string)($_POST['email'] ?? ''));
$phone   = trim((string)($_POST['phone'] ?? ''));
$product = trim((string)($_POST['product'] ?? 'Міні‑курс «7 кроків до трендових плетінь»'));
$amount  = trim((string)($_POST['amount'] ?? '890'));
$currency= trim((string)($_POST['currency'] ?? 'UAH'));

if ($email === '' || $phone === '') { http_response_code(400); echo 'Missing email/phone'; exit; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { http_response_code(400); echo 'Invalid email'; exit; }

$orderReference = 'BRAIDS_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3));
$orderDate = time();

$productNames  = [$product];
$productCounts = [1];
$productPrices = [(float)$amount];

$merchantDomainName = $_SERVER['HTTP_HOST'] ?? '';

$parts = [$merchantAccount, $merchantDomainName, $orderReference, (string)$orderDate, (string)$amount, $currency];
foreach ($productNames as $pn)  { $parts[] = $pn; }
foreach ($productCounts as $pc) { $parts[] = (string)$pc; }
foreach ($productPrices as $pp) { $parts[] = (string)$pp; }

$signatureString = implode(';', $parts);
$merchantSignature = hash_hmac('md5', $signatureString, $merchantSecretKey);

$fields = [
  'merchantAccount' => $merchantAccount,
  'merchantAuthType' => 'SimpleSignature',
  'merchantDomainName' => $merchantDomainName,
  'merchantSignature' => $merchantSignature,
  'orderReference' => $orderReference,
  'orderDate' => $orderDate,
  'amount' => $amount,
  'currency' => $currency,
  'orderTimeout' => 49000,
  'clientEmail' => $email,
  'clientPhone' => $phone,
  'language' => 'UA',
];

if ($serviceUrl !== '') $fields['serviceUrl'] = $serviceUrl;
if ($returnUrl !== '')  $fields['returnUrl']  = $returnUrl;

$purchaseUrl = 'https://secure.wayforpay.com/pay';
?><!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Перехід до оплати…</title>
</head>
<body>
  <form id="wfp" method="post" action="<?= htmlspecialchars($purchaseUrl, ENT_QUOTES) ?>" accept-charset="utf-8">
    <?php foreach ($fields as $k=>$v): ?>
      <input type="hidden" name="<?= htmlspecialchars($k, ENT_QUOTES) ?>" value="<?= htmlspecialchars((string)$v, ENT_QUOTES) ?>">
    <?php endforeach; ?>

    <?php foreach ($productNames as $pn): ?>
      <input type="hidden" name="productName[]" value="<?= htmlspecialchars($pn, ENT_QUOTES) ?>">
    <?php endforeach; ?>
    <?php foreach ($productPrices as $pp): ?>
      <input type="hidden" name="productPrice[]" value="<?= htmlspecialchars((string)$pp, ENT_QUOTES) ?>">
    <?php endforeach; ?>
    <?php foreach ($productCounts as $pc): ?>
      <input type="hidden" name="productCount[]" value="<?= htmlspecialchars((string)$pc, ENT_QUOTES) ?>">
    <?php endforeach; ?>
  </form>

  <script>document.getElementById('wfp').submit();</script>
</body>
</html>
