<?php
$routes = file_get_contents('routes/web.php');
preg_match_all('/\[\\\App\\\Http\\\Controllers\\\([^:]+)::class,\s*\'([^\']+)\'\]/', $routes, $matches);
$errors = [];
foreach ($matches[1] as $k => $class) {
    $method = $matches[2][$k];
    $file = 'app/Http/Controllers/'.str_replace('\\', '/', $class).'.php';
    if (!file_exists($file)) {
        $errors[] = "Missing Controller: $class";
        continue;
    }
    $content = file_get_contents($file);
    if (!preg_match('/function\s+'.$method.'\s*\(/', $content)) {
        $errors[] = "Missing Method: $class -> $method()";
    }
}
print_r(array_unique($errors));
