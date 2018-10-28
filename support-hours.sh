#! /bin/bash
dev="/mnt/d/MAMP/htdocs/testenviroment.local/wp-content/plugins/support-hours"
trunk="/mnt/d/MAMP/htdocs/anders/support-hours/trunk"
release="/mnt/d/MAMP/htdocs/anders/support-hours"
read -p 'Release number:' releasenumber

rm -r $release/trunk/*

cp -R $dev/admin/ $trunk/admin/
cp -R $dev/includes/ $trunk/includes/
cp -R $dev/languages/ $trunk/languages/
cp -R $dev/public/ $trunk/public/
cp -R $dev/dist/ $trunk/dist/
cp -R $dev/public/index.php $trunk/
cp -R $dev/support-hours.php $trunk/
cp -R $dev/uninstall.php $trunk/
cp -R $dev/README.txt $trunk/
cp -R $dev/LICENSE.txt $trunk/
cd $release/tags/
mkdir $releasenumber
cp -R $trunk/* $release/tags/$releasenumber/
