<?php

declare(strict_types=1);

/**
 * Slugify a given string.
 *
 * Make a pretty url slug for SEO.
 *
 * @param string $string The string to make a url from.
 *
 * @return string $url the output slug
 *
 * @throws Exception
 **/
if (!function_exists('sluggify')) {
	function sluggify(string $string): string
	{
		// replace non letter or digits by -
		$url = preg_replace('~[^\pL\d]+~u', '-', $string);

		// transliterate
		try {
			$url = iconv('utf-8', 'us-ascii//TRANSLIT', $url);
		} catch (Exception $ex) {
			return 'n-a';
		}

		// remove unwanted characters
		$url = preg_replace('~[^-\w]+~', '', $url);

		// trim
		$url = trim($url, '-');

		// remove duplicate -
		$url = preg_replace('~-+~', '-', $url);

		// lowercase
		$url = strtolower($url);

		if (empty($url)) {
			return 'n-a';
		}

		return $url;
	}
}
