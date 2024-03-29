# Travel Matching (訪日外国人と日本人のマッチングアプリ)

## 目次
1.制作背景
2.使用技術
3.ER図
4.機能
5.デモ
6.工夫した点・課題点

## 1.制作背景
最近、コロナが落ち着いた&円安の影響で訪日外国人が増えています。
しかし、訪日外国人と日本人が交流する場所があまりないと感じたため、両者でコミュニケーションを取ることのできるプラットフォームを設けたいと思い制作しました。


## 2.使用技術
AWS Cloud9

Laravel9, Vue.js, HTML/CSS, Tailwind CSS, JavaScript, PHP, MySQL, Cloudinary

## 3.ER図
https://drive.google.com/file/d/1DWJR5Q3Y15Xi3uR2YvFypouZ3nXNOv5Z/view?usp=sharing

## 4.機能
### ログイン・新規登録
- マルチ認証 ユーザ登録時に日本人か訪日外国人かを登録することでユーザ種別を判別 コントローラーでログイン後の遷移画面を切り替え
- マッチングアプリのため20歳未満は登録不可 バリデーションで実装

### マイページ・プロフィール編集
- 自分を検索したユーザにどのようなプロフィールが表示されるのかを示している
- 未登録の項目があった場合に「未登録の項目があります」と表示し登録を促す
- 居住地域(48都道府県またはアジア圏の24カ国)や趣味(7カテゴリ)の登録
- 画像アップロード機能(Cloudinary)

### 検索
- 希望条件に合ったユーザの検索・申請
- 検索結果 → 申請状況によってユーザ別に「申請」(申請ボタン) / 「申請済み」 / 「申請が届いています」(申請リストに遷移するボタン)の表示

### 申請リスト
- 申請状況を確認できる 「申請済み」「届いた申請」「繋がった人」
- 届いた申請に対し「承認」「拒否」

### チャット
- マッチングが成立した相手のみチャットが可能
- メッセージは30文字まで送信可能 バリデーションで実装


## 5.デモ
### デモURL
https://lev-matching-398333f93750.herokuapp.com/login

### Github
https://github.com/akari27/lev-matching

### テスト用アカウント

(日本人)

Email: ryokotaro@gmail.com

Password: testtest

(訪日外国人)

Email: kimsoyeon@gmail.com

Password: testtest

## 6.工夫した点・課題点
### 工夫した点
- マルチ認証を実装し、日本人に表示するUIと訪日外国人に表示するUIをそれぞれ作成した
- ユーザが登録する情報を増やした点に伴い、独自のフォームリクエストを作 バリデーションルールの設定とエラーメッセージのカスタマイズを行った
- UI向上のためSPA(Vue.js)を採用

### 課題点(今後の展望)
- 検索項目の追加 : コメントの部分検索 訪日予定日の検索等
- レコメンド機能の追加 : 年代の近い人、趣味が同じ人等を抽出しておすすめのマッチング相手として表示
- リアルタイムチャットの実装
- ブロック機能の追加
- プロフィール画像登録時の切り抜きや位置調整機能の追加
- 地域登録の改善 : プルダウンメニューで47都道府県全てを表示するのではなく、最初に地方名を選んで絞り込んだりマップ上から選択できるようにしたい