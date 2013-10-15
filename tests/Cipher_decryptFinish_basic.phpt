--TEST--
Crypto\Cipher::decryptFinish basic usage.
--FILE--
<?php
$key = str_repeat('x', 32);
$iv = str_repeat('i', 16);

$ciphertext = base64_decode('j4hToWhWBxM8ue4Px6W4pXEDk1y8OepoDe8NsHZ+lU4=');

$cipher = new Crypto\Cipher('aes-256-cbc');

// invalid order
try {
	$cipher->decryptFinish();
}
catch (Crypto\AlgorithmException $e) {
	if ($e->getCode() === Crypto\AlgorithmException::DECRYPT_FINISH_STATUS) {
		echo "FINAL STATUS\n";
	}
}

// init first
$cipher->decryptInit($key, $iv);
$result = $cipher->decryptUpdate($ciphertext);
$result .= $cipher->decryptFinish();
echo $result . "\n";
?>
--EXPECT--
FINAL STATUS
aaaaaaaaaaaaaaaa