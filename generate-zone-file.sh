#!/bin/sh

# Usage:
	# sh generate-zone-file.sh domain_name github_username github_repo

# Example:
	# sh generate-zone-file.sh productioncontrol.tv prodctrl dns

# Note:
	# Do not include a period at the end of the domain name


# Command-line styles
style_reset="\e[0m"
style_success="\e[92m"
style_error="\e[1;91m"
style_advisory="\e[93m"
style_special="\e[1;94m"


# If required parameters are missing...
if [ -z "$1" -o -z "$2" -o -z "$3" ] ; then
	# Display an error message
	echo
	echo "${style_error}Required parameters missing!${style_reset}"
	echo
	echo "	${style_success}Example:"
	echo "		sh generate-zone-file.sh productioncontrol.tv prodctrl dns${style_reset}"
	echo
	echo "	Syntax:"
	echo "		sh generate-zone-file.sh domain_name github_username github_repo"
	echo
	echo "	${style_advisory}Note:"
	echo "		Do not include a period at the end of the domain name${style_reset}"
	echo

	# Exit
	exit
fi


# Assign parameters to variables
domain="$1"
github_username="$2"
github_repo="$3"


# Paths
dir_folder="/tmp/ZoneFile"
dir_zone_file_repo="$dir_folder/repo"
dir_domain="$dir_folder/$domain"
dir_github_repo="$dir_domain/repo"
dir_output="$dir_domain/`date +%Y-%m-%d-%H-%M-%S`"
zone_file_output="$dir_output/zone_file.txt"


sleep 1


# Delete directories
echo "${style_advisory}Deleting directories...${style_reset}"
rm -rf $dir_zone_file_repo/ $dir_github_repo/
sleep 1

# Make directories
echo "${style_advisory}Creating directories...${style_reset}"
mkdir -p $dir_domain/ $dir_output/
sleep 1


# Clone repos
echo
echo "${style_advisory} Cloning prodctrl/ZoneFile.git...${style_reset}"
git clone git@github.com:prodctrl/ZoneFile.git $dir_zone_file_repo
sleep 1

echo
echo "${style_advisory} Cloning $github_username/$github_repo.git...${style_reset}"
git clone git@github.com:$github_username/$github_repo.git $dir_github_repo
sleep 1


# Generate zone file
echo
echo "${style_advisory}Generating zone file...${style_reset}"
php $dir_github_repo/zone-file-generator.php > $zone_file_output
sleep 1

echo
echo "${style_advisory}Zone file saved to $zone_file_output${style_reset}"
sleep 1

echo "${style_special}"
cat $zone_file_output
echo "${style_reset}"
sleep 1