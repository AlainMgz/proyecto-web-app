<?php
require_once __DIR__ . '/SAs/reviewSA.php';
require_once __DIR__ . '/config.php';
require_once RAIZ_APP . '/session_start.php';

$reviewSA = new ReviewSA();
$reviewSA->borrarReview($_GET['id']);
header('Location: ../lastReviews.php');