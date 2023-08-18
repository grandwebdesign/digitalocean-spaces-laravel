# DigitalOcean Spaces for Laravel

This package provides easy integration and management of DigitalOcean Spaces in Laravel applications.

## Requirements

- PHP >= 8.1
- Laravel >= 10.0

## Installation
To install the package via Composer:
```bash
composer require grandwebdesign/digitalocean-spaces-laravel
```

## Configuration
Once you've installed the package, set the following environment variables in your .env file:
```bash
DO_ACCESS_KEY_ID=
DO_SECRET_ACCESS_KEY=
DO_DEFAULT_REGION=
DO_BUCKET=
DO_CDN_ENDPOINT=
DO_ENDPOINT=
DO_FOLDER=
```

Note on DO_FOLDER: This variable can remain empty if you want to upload files to the root directory. Otherwise, specify a folder name, such as `"uploads"`, so all files will be uploaded to the `/uploads/` path.

## Usage
To upload a file
```bash
use Grandwebdesign\DigitaloceanSpacesLaravel\DigitaloceanSpaces;

$digitaloceanSpace = new DigitaloceanSpaces(
    file: $this->file('image'),
    folder: '',
    fileName: 'filename.png'
);

$fileName = $digitaloceanSpace->upload();
```

To remove a file
```bash
use Grandwebdesign\DigitaloceanSpacesLaravel\DigitaloceanSpaces;

$digitaloceanSpace = new DigitaloceanSpaces(
    file: 'filename.png',
);

$fileName = $digitaloceanSpace->delete();
```