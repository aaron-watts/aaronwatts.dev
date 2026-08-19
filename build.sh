#!/bin/bash

PROJECT_ROOT=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
PHP_PUBLIC="${PROJECT_ROOT}/public"
PHP_RUN="${PHP_PUBLIC}/index.php"
BLOGS_DIR="${PROJECT_ROOT}/src"
BUILD_DIR="${PROJECT_ROOT}/dist"

# Delete old build files
rm -R "${BUILD_DIR}"
mkdir "${BUILD_DIR}"

# Write home page to index.html
php "$PHP_RUN" > "${BUILD_DIR}/index.html"

# Write 404 page
php "$PHP_RUN" "404" > "${BUILD_DIR}/404.html"

mkdir "${BUILD_DIR}/rss"
# Write rss/index.html page
php "$PHP_RUN" "rss" > "${BUILD_DIR}/rss/index.html"

# Write collated feed
php "$PHP_RUN" "feed" > "${BUILD_DIR}/feed.xml"

# Write sitemap.xml
php "$PHP_RUN" "sitemap" > "${BUILD_DIR}/sitemap.xml"

mkdir "${BUILD_DIR}/search"
# Create search feed
php "$PHP_RUN" "search/feed.json" > "${BUILD_DIR}/search/feed.json"
# Create search page
php "$PHP_RUN" "search" > "${BUILD_DIR}/search/index.html"

# Write blog pages, posts and blog feeds
for blogDir in "${BLOGS_DIR}"/*;
do
  blog="$(basename "${blogDir}")"
  mkdir "${BUILD_DIR}/${blog}"
  php "$PHP_RUN" "$blog" > "${BUILD_DIR}/${blog}/index.html"
  php "$PHP_RUN" "${blog}/feed" > "${BUILD_DIR}/${blog}/feed.xml"

  for postFile in "${blogDir}"/*;
  do
    post="$(basename "${postFile}" .html)"
    mkdir "${BUILD_DIR}/${blog}/${post}"
    php "$PHP_RUN" "${blog}/${post}" > "${BUILD_DIR}/${blog}/${post}/index.html"
  done;
done;

# Copy root files and folders
for name in "${PHP_PUBLIC}"/*;
do
  if [ "$name" != "${PHP_PUBLIC}/index.php" ]; then
    if [ -d "$name" ]; then
      cp -R "$name" "$BUILD_DIR";
    elif [ -f "$name" ]; then
      cp "$name" "$BUILD_DIR";
    fi
  fi;
done;

