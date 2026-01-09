<?php

function app_base_url(): string
{
    if (defined('BASE_URL')) {
        return BASE_URL;
    }

    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    if ($scriptDir === '' || $scriptDir === '.') {
        return '/public';
    }

    return $scriptDir . '/public';
}

function renderLayoutHeader(string $title = 'E-BUVETTE'): void
{
    $baseUrl = app_base_url();
    $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

    echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{$safeTitle}</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{$baseUrl}/css/app.css" />
</head>
<body>
HTML;
}

function renderLayoutFooter(): void
{
    echo '</body></html>';
}
