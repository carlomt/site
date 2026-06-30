<?php

$config = parse_ini_file('config.ini');

$fields = [
    'fisica'      => 'Fisica',
    'formazione'  => 'Scienze della Formazione Primaria',
];

$level_style = [
    'Magistrale' => 'primary',
    'Triennale'  => 'success',
    'Dottorato'  => 'warning',
];

function load_theses($dir)
{
    $theses = [];
    if (!is_dir($dir)) return $theses;
    foreach (new DirectoryIterator($dir) as $f) {
        if ($f->isDot() || $f->getExtension() !== 'ini') continue;
        $data = parse_ini_file($f->getPathname());
        if ($data !== false) $theses[] = $data;
    }
    return $theses;
}

function thesis_level_badge($level, $level_style)
{
    $style = htmlspecialchars($level_style[$level] ?? 'default', ENT_QUOTES, 'UTF-8');
    return '<span class="label label-' . $style . '">' . htmlspecialchars($level, ENT_QUOTES, 'UTF-8') . '</span>';
}

// ── TESI PROPOSTE ──────────────────────────────────────────────────────────

echo '<div class="page-header" style="margin-top:0"><h2>Tesi proposte</h2></div>';
echo '<p class="text-muted">Per ulteriori informazioni su una tesi o per candidarsi contattami via email.</p>';

$any_available = false;
foreach ($fields as $subdir => $field_label) {
    $theses = load_theses("./theses/available/$subdir/");
    if (empty($theses)) continue;
    $any_available = true;

    echo '<h3>' . htmlspecialchars($field_label, ENT_QUOTES, 'UTF-8') . '</h3>';
    echo '<div class="row">';

    foreach ($theses as $t) {
        $level   = $t['level'] ?? '';
        $style   = $level_style[$level] ?? 'default';
        $topics  = isset($t['topics']) ? (array) $t['topics'] : [];

        echo '<div class="col-sm-6" style="margin-bottom:1em;">';
        echo '<div class="panel panel-' . htmlspecialchars($style, ENT_QUOTES, 'UTF-8') . '" style="height:100%;margin-bottom:0;">';

        echo '<div class="panel-heading">';
        echo '<h4 class="panel-title">';
        echo htmlspecialchars($t['title'] ?? '', ENT_QUOTES, 'UTF-8');
        echo ' <span class="pull-right">' . thesis_level_badge($level, $level_style) . '</span>';
        echo '</h4>';
        echo '</div>';

        echo '<div class="panel-body">';
        if (!empty($t['description']))
            echo '<p>' . htmlspecialchars($t['description'], ENT_QUOTES, 'UTF-8') . '</p>';
        if (!empty($t['requirements']))
            echo '<p><strong>Prerequisiti:</strong> ' . htmlspecialchars($t['requirements'], ENT_QUOTES, 'UTF-8') . '</p>';
        if (!empty($topics)) {
            echo '<p>';
            foreach ($topics as $topic)
                echo '<span class="label label-info" style="margin-right:3px;">' . htmlspecialchars($topic, ENT_QUOTES, 'UTF-8') . '</span>';
            echo '</p>';
        }
        echo '</div>';

        if (!empty($config['email'])) {
            $mailto = 'mailto:' . htmlspecialchars($config['email'], ENT_QUOTES, 'UTF-8')
                    . '?subject=' . rawurlencode('Tesi: ' . ($t['title'] ?? ''));
            echo '<div class="panel-footer">';
            echo '<a href="' . $mailto . '" class="btn btn-sm btn-' . htmlspecialchars($style, ENT_QUOTES, 'UTF-8') . '">';
            echo '<span class="glyphicon glyphicon-envelope"></span> Contattami</a>';
            echo '</div>';
        }

        echo '</div>'; // panel
        echo '</div>'; // col
    }

    echo '</div>'; // row
}

if (!$any_available)
    echo '<p class="text-muted">Nessuna tesi disponibile al momento.</p>';

// ── TESI SVOLTE ────────────────────────────────────────────────────────────

echo '<div class="page-header" style="margin-top:2em;"><h2>Tesi svolte</h2></div>';

$any_completed = false;
foreach ($fields as $subdir => $field_label) {
    $theses = load_theses("./theses/completed/$subdir/");
    if (empty($theses)) continue;
    $any_completed = true;

    usort($theses, fn($a, $b) => intval($b['year'] ?? 0) <=> intval($a['year'] ?? 0));

    echo '<h3>' . htmlspecialchars($field_label, ENT_QUOTES, 'UTF-8') . '</h3>';
    echo '<div class="list-group">';

    foreach ($theses as $t) {
        $level = $t['level'] ?? '';
        $style = $level_style[$level] ?? 'default';

        echo '<div class="list-group-item">';
        echo '<div class="row">';

        echo '<div class="col-sm-9">';
        echo '<h4 class="list-group-item-heading">' . htmlspecialchars($t['title'] ?? '', ENT_QUOTES, 'UTF-8') . '</h4>';
        echo '<p class="list-group-item-text">';
        echo htmlspecialchars($t['student'] ?? '', ENT_QUOTES, 'UTF-8');
        if (!empty($t['year'])) echo ' &middot; ' . intval($t['year']);
        echo ' &middot; ' . thesis_level_badge($level, $level_style);
        echo '</p>';
        if (!empty($t['abstract']))
            echo '<p class="text-muted" style="margin-top:0.5em;font-size:0.9em;">'
               . htmlspecialchars($t['abstract'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</div>';

        if (!empty($t['pdf'])) {
            $pdf_url = 'theses/completed/pdf/' . rawurlencode(basename($t['pdf']));
            echo '<div class="col-sm-3 text-right" style="padding-top:0.75em;">';
            echo '<a href="' . htmlspecialchars($pdf_url, ENT_QUOTES, 'UTF-8') . '" class="btn btn-sm btn-default" target="_blank">';
            echo '<span class="glyphicon glyphicon-download-alt"></span> PDF</a>';
            echo '</div>';
        }

        echo '</div>'; // row
        echo '</div>'; // list-group-item
    }

    echo '</div>'; // list-group
}

if (!$any_completed)
    echo '<p class="text-muted">Nessuna tesi completata ancora.</p>';
?>
