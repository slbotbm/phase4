# phase4
## 変更
### １月１１日：
### １２月２６日：
### １２月１９日：
#### カンサル：
- `Positions`モデル、ファクトリー、コントローラの削除
- 各コントローラ内に`index()`と`show()`関数を定義し、`Employee`, `Project`, `Technology`の一覧画面と詳細画面を作りました。（例だけ）
- `Project`テーブルにプロジェクトの状況のカラムを追加しました
### １２月５日：
#### カンサル：
- `Employee`, `Project`, `Technology`, `Positions`というモデルの定義とモデル間の連携
- 各モデルと連携テーブルのファクトリーの定義、シーダーの定義（シーダーの定義は未完成）
## Model・モデル
### Employee・社員
##### テーブルの定義
| カラムの名前            | 意味 | 種類     |
|---------------------------|---------------------------------|-----------|
| id                        | 識別子                            | Integer   |
| name                      | 名前                              | String    |
| age                       | 年齢                              | Integer   |
| sex                       | 性別                              | String    |
| start_of_employment       | 就業開始日                        | Date      |
| profile_url               | プロフィールURL                   | String    |
| still_working             | 今も働いている                    | Boolean   |
| timestamps                | タイムスタンプ                    | datetime|
##### 他のモデルとの関係
- Technology・テクノロギ: 多対多
- Position・役職：多対多関
- Project・プロジェクト：多対多
### Project・ポルジェクト
##### テーブルの定義
|    カラムの名前              | 意味       | 種類               |
|------------------------------|---------------------------------------|----------------------|
| id                           | 識別子                                  | Integer              |
| project_name                 | プロジェクト名                         | String               |
| customer_name                | 顧客名                                 | String               |
| details                      | 詳細                                   | Long Text            |
| start_date                   | 開始日                                 | Date                 |
| end_date                     | 終了日                                 | Date                 |
| hours_required_per_month     | 月間必要時間                           | Integer              |
| cost                         | コスト                                 | Integer              |
| timestamps                   | タイムスタンプ                         | datetime          |
##### 他のモデルとの関係
- Employee・社員：多対多
- Technology・テクノロギ：多対多
### Technology・テクノロギ
##### テーブルの定義
| カラムの名前        | 意味  | 種類  |
|-----------------------|----------------------------------|-----------|
| id                    | 識別子                             | Integer   |
| technology_name      | 技術名                            | String    |
| technology_field     | 技術分野                           | String    |
| timestamps            | タイムスタンプ                     | datetime|
##### 他のモデルとの関係
- Employee・社員：多対多
- Project・プロジェクト：多対多
### Associative Tables・中間テーブル
#### Employee-Technology・社員対テクノロギ
| カラム名         | 意味                           | 種類              |
|-----------------|-------------------------------|--------------------|
| id              | 識別子      | Integer|
| employee_id     | 従業員の外部キー               | Integer (外部キー制約) |
| technology_id   | 技術の外部キー                 | Integer (外部キー制約) |
|timestamps | タイムスタンプ                     | datetime|
#### Project-Technology・プロジェクトたいテクノロギ
| カラム名           | 意味                             | Type               |
|-------------------|----------------------------------|--------------------|
| id                | 識別子          | Integer |
| project_id        | プロジェクトの外部キー             | Integer (外部キー制約) |
| technology_id     | テクノロジーの外部キー             | Integer (外部キー制約) |
|timestamps | タイムスタンプ                     | datetime|
#### Project-Employee・プロジェクト対社員
| カラム名                  | 意味                                | Type               |
|--------------------------|-------------------------------------|--------------------|
| id                       | 識別子             | Integer |
| project_id               | プロジェクトの外部キー                | Integer (外部キー制約) |
| employee_id              | 従業員の外部キー                    | Integer (外部キー制約) |
| project_employee_hours   | プロジェクトにかかる従業員の時間数  | Integer (外部キー制約)              |
|timestamps | タイムスタンプ                     | datetime|

## Factory・ファクトリ
### EmployeeFactory
| カラム名               | Faker で生成されるデータの説明                                      |
|------------------------|---------------------------------------------------------------|
| name                   | フェイカーによって生成される偽名                                 |
| age                    | フェイカーによって生成される18歳から50歳までの年齢                 |
| sex                    | フェイカーによってランダムに選択される「男性」または「女性」     |
| start_of_employment    | フェイカーによって過去8年から現在までの間で生成される雇用開始日 |
| profile_url            | https://fusic.co.jp/members/ にランダムな番号が付与されるプロフィールURL |
| still_working          | フェイカーによって生成される真偽値（働いているかどうか）           |
### ProjectFactory
| カラム名                   | Faker で生成されるデータの説明                                     |
|---------------------------|------------------------------------------------------------------|
| project_name              | 3 ～ 6 語のランダムなプロジェクト名                               |
| customer_name             | ランダムに生成される企業名                                       |
| details                   | 最大 700 文字のランダムなテキスト                                |
| start_date                | 直近 6 ヶ月から次の 1 年までの間のランダムな開始日時               |
| end_date                  | 開始日時から次の 2 年以内のランダムな終了日時                    |
| hours_required_per_month  | 1 ヶ月あたりの必要な労働時間（60 ～ 100 時間のランダムな数値）    |
| cost                      | プロジェクトのコスト（1,000,000 ～ 10,000,000 円のランダムな数値）|
### TechnologyFactory
| カラム名            | Faker で生成されるデータの説明                                       |
|--------------------|--------------------------------------------------------------------|
| technology_name    | ランダムに選択された技術名                                          |
| technology_field   | 技術が属する領域（'frontend'、'server-side'、'backend' のいずれか）|
## Seeder・シーダー
1. User モデルに対して、ランダムなユーザー情報を生成し、10人分のデータをデータベースに保存します。
2. User モデルに対して、特定の情報を持つテストユーザーを1人生成し、データベースに保存します。
3. Technology モデルの生成: Technology モデルに対して、TechnologyFactory で定義された技術名とそのフィールドのリストを使用して、それぞれの技術情報を生成し、データベースに保存します。これにより、様々な技術情報がデータベースに挿入されます。
4. Employee モデルの生成とアタッチ: Employee モデルに対して、ランダムに生成された従業員情報を100人分生成し、それぞれの従業員に対してランダムに技術をアタッチします。これにより、従業員の技術スキルがデータベースに関連付けられます。
5. Project モデルの生成とアタッチ: Project モデルに対して、ランダムに生成されたプロジェクト情報を20個分生成し、それぞれのプロジェクトに対してランダムに技術と従業員をアタッチします。これにより、プロジェクトが使用する技術や関連する従業員がデータベースに登録されます。
