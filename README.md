# Site
## Dynamic PHP site without a database

This repository contains a lightweight **dynamic PHP website** that does not require a database.

Content is generated automatically from plain text or HTML files.

---

## Repository structure

```
.
├── index.php
├── config-example.ini
├── pages/
├── posts/
├── template/
├── third_party/
│   └── htmlpurifier/
│       └── library/
│           ├── HTMLPurifier.auto.php
│           └── HTMLPurifier/
└── README.md
```

External dependencies are stored under `third_party/` and managed as **git submodules**.

---

## Content management

### Pages and posts

You can add content by placing `txt` or `html` files in the following folders:

- `pages/` → static pages
- `posts/` → blog posts

Each file is parsed and automatically converted into a page or a post.

### BBCode support

Text files (`.txt`) support **BBCode markup** (currently in beta).

A list of supported BBCode commands can be found in:

```
posts/Test_txt.txt
```

BBCode files also support **syntax highlighting for code blocks**.

---

## Menus and navigation

- Pages are **automatically added to the main menu**
- Sub-menus can be created by adding **subfolders** inside the `pages/` directory

---

## Configuration

You must create a `config.ini` file in the root directory of the site.

You can start from the provided example:

```bash
cp config-example.ini config.ini
```

The `config.ini` file controls:
- general site configuration
- homepage content
- bibliography settings

The homepage is generated dynamically based on the information in `config.ini`.

---

## Bibliography support

The site can automatically generate a **bibliography page** from a `.bib` file.

The input bibliography file is specified in `config.ini`.

---

## Math and equations

LaTeX equations are supported via **MathJax**:

- Display equations: `$$ ... $$`
- Inline equations: `$ ... $`

---

## Frontend framework

The site uses **Bootstrap 3.3.7** for responsive layout:

https://getbootstrap.com/docs/3.3/getting-started/

Bootstrap is **not distributed** with this repository.

By default, Bootstrap is loaded from the author's personal webpage at Roma1 INFN.
If you are hosting the site elsewhere, you can:

- download Bootstrap locally, or
- use a CDN version

In both cases, edit:

```
template/header.htm
```

---

## HTMLPurifier dependency

This project uses **HTMLPurifier** to sanitize user-provided or generated HTML.

HTMLPurifier is included as a **git submodule** under:

```
third_party/htmlpurifier/
```

The library is loaded in PHP with:

```php
require_once __DIR__ . '/third_party/htmlpurifier/library/HTMLPurifier.auto.php';
```

Keeping HTMLPurifier as a submodule ensures compatibility with PHP 8+ and allows
easy updates from the upstream repository.

---

## Installation

### Clone the repository with submodules

Clone the repository and initialize submodules in one step:

```bash
git clone --recurse-submodules https://github.com/carlomt/site.git
```

If you already cloned the repository without submodules:

```bash
git submodule update --init --recursive
```

---

## Updating dependencies

To update HTMLPurifier (or other submodules) to the latest upstream version:

```bash
git submodule update --remote
```

Then commit the updated reference:

```bash
git commit -am "Update third-party dependencies"
```

---

## Requirements

- PHP ≥ 7.4
- PHP 8.x supported (requires updated HTMLPurifier submodule)
- No database required

---

## License

This repository is distributed under its own license.
Third-party components are distributed under their respective licenses.
