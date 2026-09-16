# TODO

The five new Vahlsing/Fahlsing and three new Krückeberg files are listed
in:

- `~/gens/valhsing-files.txt`
- `~/gens/krueckeberg-files.txt`

The Valhsing/Fahlsing and Krückeberg entries were removed from `~/gens/code/results.yml`.

Next, create the Weiland[t]/Weyland]t]/Wiland/Weÿland `.md` files:
 
1. Run `pfp main.php` in `~/temp/sphinx-gen` and create the new Weiland markdown file.         <== DONE
2. Have Claude change `_toc.yml` to incorporate the new `.md` files. These will go under the   <== DONE
  'weiland' section. They will be chronological order using the file names of the files in
  `code/logs/xxx.log`.

3. Copy the `code/images` image files to `petzen/images`.
4. build the site: `jb clean . && jb build .`
5. Check the order by actual dates in the file.


7. U
- If all the new site looks correct, then 
  - Run `~/gens/code/main.php`, and copy `~/temp/sphinx-gen` to `~/gens`.
  - Build the site and confirm it works.
