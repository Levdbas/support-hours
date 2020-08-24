#! /bin/bash
dev="/mnt/d/laragon/www/testenvironment.local/web/app/plugins/support-hours"
trunk="/mnt/d/laragon/www/anders/support-hours/trunk"
release="/mnt/d/laragon/www/anders/support-hours"
read -p 'Release number:' releasenumber

rm -r $trunk/*

cp -R $dev/admin/ $trunk/admin/
cp -R $dev/includes/ $trunk/includes/
cp -R $dev/languages/ $trunk/languages/
cp -R $dev/dist/ $trunk/dist/
cp -R $dev/support-hours.php $trunk/
cp -R $dev/uninstall.php $trunk/
cp -R $dev/README.txt $trunk/
cp -R $dev/LICENSE.txt $trunk/
cd $release/tags/
mkdir $releasenumber
cp -R $trunk/* $release/tags/$releasenumber/
