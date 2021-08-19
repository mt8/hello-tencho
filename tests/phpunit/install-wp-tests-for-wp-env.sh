SCRIPT_DIR=$(cd $(dirname $0); pwd)
TMPDIR="$SCRIPT_DIR"/tmp
WP_TESTS_DIR=$(echo $TMPDIR | sed -e "s/\/$//")

WP_TESTS_TAG="tags/5.8"

#test-mysql
DB_NAME="tests-wordpress"
DB_USER="root"
DB_PASS="password"
DB_HOST="tests-mysql"

if [ ! -d $WP_TESTS_DIR ]; then
	mkdir -p $WP_TESTS_DIR
	svn co --quiet https://develop.svn.wordpress.org/${WP_TESTS_TAG}/tests/phpunit/includes/ "$WP_TESTS_DIR"/includes
	svn co --quiet https://develop.svn.wordpress.org/${WP_TESTS_TAG}/tests/phpunit/data/ "$WP_TESTS_DIR"/data
fi

if [ ! -f ${WP_TESTS_DIR}/wp-tests-config.php ]; then
	svn export --quiet https://develop.svn.wordpress.org/${WP_TESTS_TAG}/wp-tests-config-sample.php "$WP_TESTS_DIR"/wp-tests-config.php
	# remove all forward slashes in the end
	WP_CORE_DIR="/var/www/html"
	WP_CORE_DIR=$(echo $WP_CORE_DIR | sed "s:/\+$::")
	sed -i "" "s:dirname( __FILE__ ) . '/src/':'$WP_CORE_DIR/':" "$WP_TESTS_DIR"/wp-tests-config.php
	sed -i "" "s/youremptytestdbnamehere/$DB_NAME/" "$WP_TESTS_DIR"/wp-tests-config.php
	sed -i "" "s/yourusernamehere/$DB_USER/" "$WP_TESTS_DIR"/wp-tests-config.php
	sed -i "" "s/yourpasswordhere/$DB_PASS/" "$WP_TESTS_DIR"/wp-tests-config.php
	sed -i "" "s|localhost|${DB_HOST}|" "$WP_TESTS_DIR"/wp-tests-config.php
fi
