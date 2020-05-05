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