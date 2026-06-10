# In‑Area PHP Library

A lightweight PHP library for geographic calculations.

## Features
- **LatLng**: Simple latitude/longitude container with distance calculations.
- **CRS**: Coordinate reference system helpers (Earth radius, projections).
- **Geometry**: Basic geometric primitives (Point, Bounds, Transformations).
- **Helper utilities**: Number formatting, word splitting, range wrapping.

## Example
```
cd .\example
php -S localhost:8080
```
to check if inside the coordinates are inside the area or not , click on the map random points until you see a shape, click inside the area to see the result.


## Basic Usage
```php
use Location\LatLng;

$pointA = new LatLng(40.7128, -74.0060); // New York
$pointB = new LatLng(34.0522, -118.2437); // Los Angeles

$distanceKm = $pointA->distanceTo($pointB);
echo "Distance: {$distanceKm} km\n";
```

See the [API Reference](api.md) for detailed class documentation.
