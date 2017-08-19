# # Content Sections [BEGIN]

lib.head < styles.content.get
lib.head.select.where = colPos = 1
#lib.head.slide = -1

lib.content < styles.content.get
lib.content.select.where = colPos = 0

# # Content Sections [END]
