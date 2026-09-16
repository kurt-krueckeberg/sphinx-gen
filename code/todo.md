# TODO

The five new Vahlsing/Fahlsing and three new Krückeberg files are listed
in:

- `~/gens/valhsing-files.txt`
- `~/gens/krueckeberg-files.txt`

The Valhsing/Fahlsing and Krückeberg entries were removed from `~/gens/code/results.yml`.

Next, create the Weiland[t]/Weyland]t]/Wiland/Weÿland `.md` files:
 
1. Run `pfp main.php` in `~/temp/sphinx-gen` and create the new Weiland markdown file.
2. Have Claude change `_toc.yml` to incorporate the new `.md` files. These
   will go under the 'weiland' section. They will be chronological order
   using the file names of the files in `code/logs/xxx.log`, and the file's h1 header
   will be compared to the h1 header of files for the same year.

3. Copy the `code/images` image files to `petzen/images`.
4. build the site: `jb clean . && jb build .`
5. Verify the chronological order and check the contents of several files.
6. U
- If all the new site looks correct, then 
  - Run `~/gens/code/main.php`, and copy `~/temp/sphinx-gen` to `~/gens`.
  - Build the site and confirm it works.
