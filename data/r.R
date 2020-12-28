devtools::install_github("muschellij2/rscopus")
rscopus::get_api_key("27ce58c4ec5526248f843bd1281a199b")

library(rscopus)
library(dplyr)

res = author_df(last_name = "Muschelli", first_name = "John", verbose = FALSE, general = FALSE)
names(res)
head(res[,c("title","journal","description")])

num <- head(res[,c("title")])
sum(complete.cases(num))
barplot(sum(complete.cases(num)),names= "Pakorn Ditthakit" ,
        col=rgb(0.8,0.1,0.1,0.6),xlab="Article", ylab="Counts", main="Counts Article", 
        ylim=c(0,10))