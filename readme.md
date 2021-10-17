# Hello-tencho

<!--
TODO:
- 各テストの簡単な説明
- 各テストの公式ドキュメントページへのリンク
- 英訳
-->

プラグインを開発するときのバックエンドのテストとフロントエンドテストを含んだ雛形。

## 必須環境

- docker
    - [Get Started with Docker](https://www.docker.com/get-started)
- node
    - [公式ページ](https://nodejs.org/ja/)
    - 複数のnodeバージョンを扱えるnodenvを推奨
        - [Installation](https://github.com/nodenv/nodenv#installation)
- composer
    - Getting Started: [Installation - Linux / Unix / macOS#](https://getcomposer.org/doc/00-intro.md)
    - macOSの場合は `brew install composer` でも可
- wp-env
    - [ドキュメント](https://ja.wordpress.org/team/handbook/block-editor/reference-guides/packages/packages-env/)
    - インストール: `npm -g i @wordpress/env`

## クイックインストラクション

1. ディレクトリ作成、移動:
    - e.g.: `mkdir -p ~/temp/hello-tencho && cd ~/temp/hello-tencho`
1. Gitクローン: `git clone git@github.com:mt8/hello-tencho.git .`
1. インストールnode_modules/: `npm install`
1. インストールvendor/: `composer install`
1. 実行: `composer test`
    - wp-env 環境起動も含めてテストが実行される
1. wp-env環境の停止: `wp-env stop`
