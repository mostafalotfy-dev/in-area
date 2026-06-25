# In Area - Location Library

A PHP library for handling geographic coordinates, 2D geometry, pathfinding, and basic spatial calculations.

## Installation

Install using composer:

```bash
composer require your-vendor/in-area # Update with actual package name
composer install 
composer update
```


## Features

This library is composed of several modules:

### 1. Coordinates and Geography (`Location\Geo`)

- **`Location\LatLng`**: Represents a geographic coordinate with latitude, longitude, and optional altitude. Allows checking equality with margins, and calculating distance to other points on Earth.
- **Coordinate Reference Systems (`Location\Geo\Crs`)**: 
  - **`Earth`**: Utility class for the Earth's CRS. Provides distance calculation between two `LatLng` objects using the Haversine formula (Mean Earth Radius: 6371km).
  - **`Simple`**: Basic projection reference.
  - **`CRS`**: Abstract class for wrapping latitude and longitude boundaries.

### 2. Geometry (`Location\Geometry`)

- **`Point`**: Represents a 2D geometric point (X, Y). Includes utility methods for basic math operations (add, subtract, negate, round, bounds checking).
- **`Bounds`**: Represents a rectangular area, defined by min and max `Point`s. Allows adding new points to expand bounds, overlap checking, checking if it contains a point, etc. Implements `Iterator`, `ArrayAccess`, and `Countable`.
- **`Transformation`**: Provides vector-based transformations (scaling, translation) to transform and untransform points.

### 3. Pathfinding (`Location\PathFinding`)

- **`Graph`**: A basic graph implementation using an adjacency list. Supports generic Breadth-First Search (BFS) and includes a stubbed Dijkstra's algorithm.

### 4. Traits (`Location\Traits`)

- **`Encapsulate`**: A trait that encapsulates methods, intercepting `__call` to invoke internal methods if they exist or throw an `InvalidArgumentException`.

## Examples

For comprehensive usage examples, please check the `example/` directory.
