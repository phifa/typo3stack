#!/usr/bin/env bash

echo "Name of your child extension (no symbols, dots, etc. Just domain with ending, e.g.: domaintld): template_ "
read input_variable
echo "Your child extension will be renamed to: template_$input_variable"
echo "..."

find public/typo3conf/ext/template_site1/ -type f -print0 | xargs -0 sed -i 's/template\_site1/template_'"$input_variable"'/g' && mv public/typo3conf/ext/template_site1 public/typo3conf/ext/template_$input_variable && vendor/bin/typo3cms cache:flush && composer remove phifa/template_site1


