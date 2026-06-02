<?php

declare(strict_types=1);

// Establece el directorio raíz del proyecto para que los paths relativos funcionen correctamente
chdir(__DIR__);

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/stats.php";
require_once __DIR__ . "/src/card.php";
require_once __DIR__ . "/src/cache.php";

// load .env (solo aplica en desarrollo local; en Vercel usa variables del dashboard)
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// En Vercel las variables del dashboard llegan via getenv(), no siempre via $_SERVER.
// Las copiamos a $_SERVER para que el resto del código funcione igual.
foreach (["TOKEN", "TOKEN2", "TOKEN3", "WHITELIST", "DISABLE_CACHE"] as $envKey) {
    if (!isset($_SERVER[$envKey])) {
        $val = getenv($envKey);
        if ($val !== false && $val !== "") {
            $_SERVER[$envKey] = $val;
        }
    }
}

// if environment variables are not loaded, display error
if (!isset($_SERVER["TOKEN"])) {
    renderOutput("Falta la variable TOKEN. Agrégala en Vercel: Settings → Environment Variables → TOKEN.", 500);
}

// set cache to refresh once per day (24 hours)
$cacheSeconds = CACHE_DURATION;
header("Expires: " . gmdate("D, d M Y H:i:s", time() + $cacheSeconds) . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: public, max-age=$cacheSeconds");

// redirect to demo site if user is not given
if (!isset($_REQUEST["user"])) {
    header("Location: /demo");
    exit();
}

try {
    $user = preg_replace("/[^a-zA-Z0-9\-]/", "", $_REQUEST["user"]);
    $startingYear = isset($_REQUEST["starting_year"]) ? intval($_REQUEST["starting_year"]) : null;
    $validModes = ["daily", "weekly"];
    $mode = isset($_GET["mode"]) && in_array($_GET["mode"], $validModes, true) ? $_GET["mode"] : null;
    $excludeDaysRaw = $_GET["exclude_days"] ?? "";

    $cacheOptions = [
        "starting_year" => $startingYear,
        "mode" => $mode,
        "exclude_days" => $excludeDaysRaw,
    ];

    $useCache = !isset($_SERVER["DISABLE_CACHE"]) || strtolower($_SERVER["DISABLE_CACHE"]) !== "true";
    $cachedStats = $useCache ? getCachedStats($user, $cacheOptions) : null;

    if ($cachedStats !== null) {
        $stats = $cachedStats;
    } else {
        $contributionGraphs = getContributionGraphs($user, $startingYear);
        $contributions = getContributionDates($contributionGraphs);

        if ($mode === "weekly") {
            $stats = getWeeklyContributionStats($contributions);
        } else {
            $excludeDays = normalizeDays(explode(",", $excludeDaysRaw));
            $stats = getContributionStats($contributions, $excludeDays);
        }

        if ($useCache) {
            setCachedStats($user, $cacheOptions, $stats);
        }
    }

    renderOutput($stats);
} catch (InvalidArgumentException | AssertionError $error) {
    error_log("Error {$error->getCode()}: {$error->getMessage()}");
    if ($error->getCode() >= 500) {
        error_log($error->getTraceAsString());
    }
    renderOutput($error->getMessage(), $error->getCode());
}
