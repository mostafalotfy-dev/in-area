# API Reference

## `Location\\LatLng`

```php
use Location\\LatLng;

$point = new LatLng(float $lat, float $lng, float $alt = null);
```

* **Properties**
  - `public $lat` – latitude (float)
  - `public $lng` – longitude (float)
  - `public $alt` – optional altitude (float|null)
* **Methods**
  - `equals(LatLng $latLng, ?int $maxMargin = null): bool` – compare two points with optional margin.
  - `distanceTo(LatLng $other): float|int` – distance in kilometers using the Earth CRS.

---

## `Location\\Geo\\Crs\\Earth`

Provides the Earth radius and a `distance(LatLng $a, LatLng $b): float` helper used by `LatLng::distanceTo`.

---

## `Location\\Geo\\Crs\\CRS`

Base abstract class for coordinate reference systems. Implements `wrapLatLng(LatLng $latLng): LatLng` to keep coordinates within valid bounds.

---

## Geometry Helpers (`Location\\Geometry`)
 
- **`Point`** – Represents a 2‑D point.
  * **Properties**
    - `private $x` – X-coordinate (float)
    - `private $y` – Y-coordinate (float)
  * **Methods**
    - `__construct(float $x, float $y, bool $round = false)` – Creates a new Point.
    - `getX(): float` – Returns the X-coordinate.
    - `getY(): float` – Returns the Y-coordinate.
    - `copy(): Point` – Returns a new Point with the same coordinates.
    - `distanceTo(Point $point): float` – Calculates the Euclidean distance to another Point.
    - `equals(Point $point): bool` – Checks if two Points have the same coordinates.
    - `contains(Point $point): bool` – Checks if the given point is within the absolute bounds of this point (e.g., for vector magnitude comparison).
    - `subtract(Point $point): Point` – Returns a new Point representing the difference.
    - `dividedBy(Point $point): Point` – Returns a new Point representing the division.
    - `multiplyBy(Point $point): Point` – Returns a new Point representing the multiplication.
    - `scaleBy(Point $point): Point` – Returns a new Point scaled by another Point's coordinates.
    - `unscaleBy(Point $point): Point` – Returns a new Point unscaled by another Point's coordinates.
    - `round(): Point` – Returns a new Point with rounded coordinates.
    - `floor(): Point` – Returns a new Point with floor-ed coordinates.
    - `ceil(): Point` – Returns a new Point with ceil-ed coordinates.
    - `toLatLong(): LatLng` – Converts the Point to a LatLng object.
    - `negate(): Point` – Returns a new Point with negated coordinates.
    - `add(Point $point): Point` – Returns a new Point representing the sum.
    - `isEven(): bool` – Determines if the sum of the point's integer coordinates is even.
    - `isOdd(): bool` – Determines if the sum of the point's integer coordinates is odd.
- **`Bounds`** – Axis‑aligned bounding box.
  * **Properties**
    - `public $min` – The minimum Point (top-left).
    - `public $max` – The maximum Point (bottom-right).
  * **Methods**
    - `__construct(array $a, ?array $b = null)` – Creates a Bounds object from an array of Points or two Points.
    - `fromArray(array $points): Bounds` – Static method to create Bounds from an array of coordinate pairs.
    - `add(Point $point): self` – Expands the bounds to include a new Point.
    - `getCenter(bool $round = false): Point` – Returns the center Point of the bounds.
    - `getBottomLeft(): Point` – Returns the bottom-left Point of the bounds.
    - `getTopRight(): Point` – Returns the top-right Point of the bounds.
    - `getTopLeft(): Point` – Returns the top-left Point of the bounds.
    - `getBottomRight(): Point` – Returns the bottom-right Point of the bounds.
    - `getSize(): Point` – Returns a Point representing the width and height of the bounds.
    - `overlaps(Bounds $bounds): bool` – Checks if this bounds object overlaps with another.
    - `contains(Point|Bounds $point): bool` – Checks if a Point or another Bounds object is entirely contained within this bounds.
    - `intersect(Bounds $bounds): bool` – Checks if this bounds object intersects with another.
    - `isValid(): bool` – Checks if the bounds object has valid min and max points.
- **`Transformation`** – Simple coordinate transformation utilities.
  * **Methods**
    - `__construct(float $a, float $b, float $c, float $d)` – Initializes the transformation matrix. Can also accept an array of 4 values.
    - `transform(Point $point, float $scale = 1): Point` – Applies the transformation to a Point, returning a new transformed Point.
    - `untransform(Point $point, float $scale = 1): Point` – Reverses the transformation on a Point, returning a new untransformed Point.

---

## Helper Functions (`helper/helper.php`)

- `formatNumber($num, $digits = null)` – Round numbers with optional precision.
- `trim($str)` – Wrapper around PHP `trim`.
- `splitWords($str)` – Split a string into words.
- `wrapNum($x, array $range, $includeMax = false)` – Wrap a number into a range.

---

All classes follow PSR‑4 autoloading under the `Location\\` namespace.

For detailed method signatures, refer to the source files in `src/`.
