# # Language [BEGIN]

config {
	linkVars = L
	sys_language_overlay = 1
	stdWrap {
		htmlSpecialChars = 1
	}
}

[globalVar = GP:L != 0]

tt_content.stdWrap.dataWrap >
tt_content.stdWrap.prepend.dataWrap >

[global]

# # German
config {
	sys_language_uid = 0
	language = de
	locale_all = de_DE.UTF-8
	htmlTag_setParams = lang="de"
}

page {
	config {
		locale_all = de_DE.UTF-8
	}
}

# # English
[globalVar = GP:L = 1]

config {
	sys_language_uid = 1
	language = en
	locale_all = en_GB.UTF-8
	htmlTag_setParams = lang="en"
}

page {
	config {
		locale_all = en_GB.UTF-8
	}
}

[global]

# # Language [END]