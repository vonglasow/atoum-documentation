# Translation
[![Crowdin](https://d322cqt584bo4o.cloudfront.net/atoum-documentation/localized.png)](https://crowdin.com/project/atoum-documentation)

## Translator informations

We use crowdin (see [crowdin project](https://crowdin.com/project/atoum-documentation)) and his [client](https://crowdin.com/page/cli-tool) to manage the translation.

### Usage
To send source files:

	crowdin-cli upload source

To download the translations:

	crowdin-cli download

## Translate pages
You can directly edit page (but don't forget to copy them on crowdin after the translation) or you can use the interface of crowdin directly. The second options is easier and more clear for everyone.

## Adding new pages

1. Create the page, in french (french is the reference) or at least create an issue to ask someone do it
1. This page must have a name related to his content and should be named in the spoken language
1. In *source/LANGUAGE/index.rst* file create the link to your new page
1. In *crowdin.yaml* file create the information about this page, to be ready to translate
1. Push the new page to crowdin

## Adding new Language

1. Create the new directory under *source/LANGUAGE*, where *LANGUAGE* is the two letter of the choosen language
1. In crowdin.yaml file add the new language for each translatation (under *languages_mapping*)
1. Push your tanslation to crowdin

## Build the documentation

### Usage

	php builddoc

Or you can also use

	./builddoc

### Requirements

* Having [sphinx installed](http://sphinx-doc.org/install.html)
* Having php cli available
* Having crowdin-cli installed

## F.A.Q.

### Why crowdin?
[Crowdin](https://crowdin.com/project/atoum-documentation) is an help to see the progression of the translation. It's have also a good suggestion modules created both from the already translated parts and from bing translator.

### Does we need to translate anchor?
Anchor in the documentation appear on this form 

	.. _installation-par-composer:

They must stay the same. It will be easier for other people to translate other page refereing this anchor. Otherwise, you risk some broken link.

### Where can I find the syntax for the files?
We use the reStructuredText syntax. You can find it on the [sphinx website](http://sphinx-doc.org/rest.html).

### What are the title underline order?
In reStructuredText syntax, you can use a wide variety of character to underline. The order use in the atoum documentation is : #, *, =, -, ", ^, `, :, ., ' . Now if you have more than 4 subdivisions, think subdivide into multiple files.

### What's the licence of this documentation.
This documentation is under CC by-nc-sa 4.0. You can find more information on [this page](LICENCE.md)

### I have a problem, where can I find help?
You can check our IRC channels [##atoum on freenode](https://webchat.freenode.net/?channels=##atoum)
