if [ $# -lt 3 ]; then
	echo "usage: $0 <db-name> <db-user> <db-pass> <db-host> [wp-version]"
	exit 1
fi

DB_NAME=$1
DB_USER=$2
DB_PASS=$3
DB_HOST=$4
WP_VERSION=${5-latest}

SCRIPT_DIR=$(cd $(dirname $0); pwd)
TMPDIR="$SCRIPT_DIR"/tmp
WP_TESTS_DIR=$(echo $TMPDIR | sed -e "s/\/$//")

download() {
    if [ `which curl` ]; then
        curl -s "$1" > "$2";
    elif [ `which wget` ]; then
        wget -nv -O "$2" "$1"
    fi
}

if [[ $WP_VERSION =~ ^[0-9]+\.[0-9]+\-(beta|RC)[0-9]+$ ]]; then
	WP_BRANCH=${WP_VERSION%\-*}
	WP_TESTS_TAG="branches/$WP_BRANCH"

elif [[ $WP_VERSION =~ ^[0-9]+\.[0-9]+$ ]]; then
	WP_TESTS_TAG="branches/$WP_VERSION"
elif [[ $WP_VERSION =~ [0-9]+\.[0-9]+\.[0-9]+ ]]; then
	if [[ $WP_VERSION =~ [0-9]+\.[0-9]+\.[0] ]]; then
		# version x.x.0 means the first release of the major version, so strip off the .0 and download version x.x
		WP_TESTS_TAG="tags/${WP_VERSION%??}"
	else
		WP_TESTS_TAG="tags/$WP_VERSION"
	fi
elif [[ $WP_VERSION == 'nightly' || $WP_VERSION == 'trunk' ]]; then
	WP_TESTS_TAG="trunk"
else
	# http serves a single offer, whereas https serves multiple. we only want one
	download http://api.wordpress.org/core/version-check/1.7/ /tmp/wp-latest.json
	grep '[0-9]+\.[0-9]+(\.[0-9]+)?' /tmp/wp-latest.json
	LATEST_VERSION=$(grep -o '"version":"[^"]*' /tmp/wp-latest.json | sed 's/"version":"//')
	if [[ -z "$LATEST_VERSION" ]]; then
		echo "Latest WordPress version could not be found"
		exit 1
	fi
	WP_TESTS_TAG="tags/$LATEST_VERSION"
fi

set -ex

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
