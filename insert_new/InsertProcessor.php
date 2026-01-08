<?php
/**
 * 医療機関データ登録処理の一元管理クラス
 * 
 * POSTデータを受け取り、セッションに構造化して保存
 * バリデーションと型変換を統一的に処理
 */
class InsertProcessor {
    private $dbh;
    private $user_adm;
    private $data = [];
    private $errors = [];
    
    // 診療科目の定義（一覧処理用）
    const DEPARTMENTS = [
        'int', 'ped', 'sur', 'ort', 'oph', 'ent', 'so', 'gyn', 'psy', 'den'
    ];
    
    const DAYS = ['mon', 'tue', 'wed', 'thr', 'fri', 'sat', 'sun'];
    
    public function __construct($dbh, $user_adm) {
        $this->dbh = $dbh;
        $this->user_adm = $user_adm;
    }
    
    /**
     * POSTデータをセッション用にパース
     */
    public function parsePostData($postData) {
        $this->data = [
            'basic' => $this->parseBasicInfo($postData),
            'schedule' => $this->parseScheduleInfo($postData),
            'medical' => $this->parseMedicalInfo($postData),
            'director' => $this->parseDirectorInfo($postData),
            'relations' => $this->parseRelationsInfo($postData),
            'fields' => $this->parseFieldsInfo($postData),
            'cooperation' => $this->parseCooperationInfo($postData),
            'social_meeting' => $this->parseSocialMeetingInfo($postData),
        ];
        
        return $this->data;
    }
    
    /**
     * 基本情報をパース
     */
    private function parseBasicInfo($post) {
        $basic = [
            'hos_cd' => $post['hos_cd'] ?? '',
            'op_flg' => $post['op_flg'] ?? '',
            'hos_div' => $post['hos_div'] ?? '',
            'hos_name' => $post['hos_name'] ?? '',
            'med_ass' => $post['med_ass'] ?? '',
            'zipcode' => $post['zipcode'] ?? '',
            'pre' => $post['pre'] ?? '',
            'city' => $post['city'] ?? '',
            'zone' => $post['zone'] ?? '',
            'town' => $post['town'] ?? '',
            'str_num' => $post['str_num'] ?? '',
            'tel' => $post['tel'] ?? '',
            'fax' => $post['fax'] ?? '',
            'mail' => $post['mail'] ?? '',
            'note' => $post['note'] ?? '',
        ];
        
        // 都道府県別の区域コード処理
        if ($post['pre'] === '岡山県') {
            $basic['area'] = $post['area1'] ?? '';
            $basic['are_cd'] = $post['are_cd1'] ?? '';
        } elseif ($post['pre'] === '広島県') {
            $basic['area'] = $post['area2'] ?? '';
            $basic['are_cd'] = $post['are_cd2'] ?? '';
        } else {
            $basic['area'] = '';
            $basic['are_cd'] = '';
        }
        
        // 閉院日は閉院フラグが立った時のみ
        $basic['clo_day'] = ($post['op_flg'] === '0') ? ($post['clo_day'] ?? '') : '';
        
        return $basic;
    }
    
    /**
     * 診療時間情報をパース
     */
    private function parseScheduleInfo($post) {
        $schedule = [
            'con_hour' => $post['con_hour'] ?? '',
        ];
        
        foreach (self::DAYS as $day) {
            $schedule["{$day}_am"] = $this->processDiagnosisTime(
                $post["{$day}_am"] ?? '',
                $post["{$day}_am1"] ?? ''
            );
            $schedule["{$day}_pm"] = $this->processDiagnosisTime(
                $post["{$day}_pm"] ?? '',
                $post["{$day}_pm1"] ?? ''
            );
        }
        
        $schedule['holiday'] = $this->processDiagnosisTime(
            $post['holiday'] ?? '',
            $post['holiday1'] ?? ''
        );
        
        return $schedule;
    }
    
    /**
     * 診療時間の処理（形式変換）
     * 午前・午後両方:★, 手術日のみ:★, 通常診療のみ:●, なし:×
     */
    private function processDiagnosisTime($officeHours, $dayOfSurgery) {
        if ($officeHours !== '' && $dayOfSurgery !== '') {
            return '★';
        } elseif ($dayOfSurgery !== '') {
            return '★';
        } elseif ($officeHours !== '') {
            return '●';
        }
        return '×';
    }
    
    /**
     * 医療情報をパース
     */
    private function parseMedicalInfo($post) {
        $medical = [];
        
        // 各診療科の有無をチェック
        foreach (self::DEPARTMENTS as $dept) {
            $medical["{$dept}_med"] = getCheckboxValue($post["{$dept}_med"] ?? null);
        }
        
        // etc カテゴリ
        $medical['etc_med'] = getCheckboxValue($post['etc_med'] ?? null);
        
        // 各診療科の専門分野をパース
        $medical = array_merge($medical, $this->parseMedicalSpecialties($post));
        
        // 共通の診療内容
        $commonServices = ['alle', 'pat', 'checkup', 'rad', 'cli', 'ane', 'eme'];
        foreach ($commonServices as $service) {
            $medical[$service] = getCheckboxValue($post[$service] ?? null);
        }
        
        // 床情報
        $medical['bed'] = $post['bed'] ?? '';
        $medical['bed_reh'] = getCheckboxValue($post['bed_reh'] ?? null);
        $medical['bed_tre'] = getCheckboxValue($post['bed_tre'] ?? null);
        $medical['bed_main'] = getCheckboxValue($post['bed_main'] ?? null);
        $medical['bed_care'] = getCheckboxValue($post['bed_care'] ?? null);
        $medical['bed_tra'] = getCheckboxValue($post['bed_tra'] ?? null);
        $medical['bed_att'] = getCheckboxValue($post['bed_att'] ?? null);
        
        // リハビリテーション関連
        $medical['pt'] = getCheckboxValue($post['pt'] ?? null);
        $medical['ot'] = getCheckboxValue($post['ot'] ?? null);
        $medical['st'] = getCheckboxValue($post['st'] ?? null);
        
        // 備考
        $medical['dep_note'] = $post['dep_note'] ?? '';
        
        return $medical;
    }
    
    /**
     * 診療科の専門分野をパース
     */
    private function parseMedicalSpecialties($post) {
        $specialties = [];
        
        // 内科系
        $intFields = ['int_int', 'int_dig', 'int_uri', 'int_tum', 'int_res', 'int_kid', 'int_blo', 'int_apo', 'int_cir', 'int_ner', 'int_inf'];
        foreach ($intFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 小児科系
        $pedFields = ['ped_ped', 'ped_sur', 'ped_neo'];
        foreach ($pedFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 外科系
        $surFields = ['sur_sur', 'sur_lac', 'sur_ner', 'sur_nes', 'sur_dig', 'sur_car', 'sur_ven'];
        foreach ($surFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 整形外科系
        $ortFields = ['ort_rhe', 'ort_cos', 'ort_ort', 'ort_reh', 'ort_pla'];
        foreach ($ortFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 眼科
        $specialties['oph_oph'] = getCheckboxValue($post['oph_oph'] ?? null);
        
        // 耳鼻咽喉科系
        $entFields = ['ent_ent', 'ent_to'];
        foreach ($entFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 泌尿器科系
        $soFields = ['so_sky', 'so_org'];
        foreach ($soFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 婦人科系
        $gynFields = ['gyn_gyn', 'gyn_obs', 'gyn_gyne'];
        foreach ($gynFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 精神科系
        $psyFields = ['psy_psy', 'psy_psyc'];
        foreach ($psyFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        // 歯科系
        $denFields = ['den_den', 'den_cav', 'den_ref', 'den_ped'];
        foreach ($denFields as $field) {
            $specialties[$field] = getCheckboxValue($post[$field] ?? null);
        }
        
        return $specialties;
    }
    
    /**
     * 理事長・病院長情報をパース
     */
    private function parseDirectorInfo($post) {
        return [
            'chi_name' => $post['chi_name'] ?? '',
            'chi_spe' => $post['chi_spe'] ?? '',
            'chi_year' => $post['chi_year'] ?? '',
            'chi_sch' => $post['chi_sch'] ?? '',
            'chi_note' => $post['chi_note'] ?? '',
            'pre_name' => $post['pre_name'] ?? '',
            'pre_spe' => $post['pre_spe'] ?? '',
            'pre_year' => $post['pre_year'] ?? '',
            'pre_sch' => $post['pre_sch'] ?? '',
            'pre_note' => $post['pre_note'] ?? '',
            'drct_note' => $post['drct_note'] ?? '',
        ];
    }
    
    /**
     * 親族情報をパース
     */
    private function parseRelationsInfo($post) {
        return [
            'rel_insert' => $post['rel_insert'] ?? [],
        ];
    }
    
    /**
     * 部門連絡先をパース
     */
    private function parseFieldsInfo($post) {
        return [
            'fie_insert' => $post['fie_insert'] ?? [],
            'num_note' => $post['num_note'] ?? '',
        ];
    }
    
    /**
     * 医療連携情報をパース
     */
    private function parseCooperationInfo($post) {
        return [
            'intr_note' => $post['intr_note'] ?? '',
            'tra_note' => $post['tra_note'] ?? '',
            'carna' => getCheckboxValue($post['carna'] ?? null),
            'kurashiki_path' => $post['c_path1'] ?? [],
            'okayama_path' => $post['c_path2'] ?? [],
            'coop_note' => $post['coop_note'] ?? '',
            'con_note' => $post['con_note'] ?? '',
            'med_care' => $post['med_care'] ?? [],
            'mcare_note' => $post['mcare_note'] ?? '',
        ];
    }
    
    /**
     * 医療連携懇話会情報をパース
     */
    private function parseSocialMeetingInfo($post) {
        $socialMeeting = [];
        
        if (isset($post['kurashiki_sm']) && $post['kurashiki_sm'] !== '') {
            $kurashiki_sm = array_filter(array_unique(explode("\r\n", $post['kurashiki_sm'])));
            sort($kurashiki_sm);
            $socialMeeting['kurashiki_sm'] = $kurashiki_sm;
        }
        
        if (isset($post['okayama1_sm']) && $post['okayama1_sm'] !== '') {
            $okayama1_sm = array_filter(array_unique(explode("\r\n", $post['okayama1_sm'])));
            sort($okayama1_sm);
            $socialMeeting['okayama1_sm'] = $okayama1_sm;
        }
        
        if (isset($post['okayama2_sm']) && $post['okayama2_sm'] !== '') {
            $okayama2_sm = array_filter(array_unique(explode("\r\n", $post['okayama2_sm'])));
            sort($okayama2_sm);
            $socialMeeting['okayama2_sm'] = $okayama2_sm;
        }
        
        return $socialMeeting;
    }
    
    /**
     * データを検証
     */
    public function validate() {
        $this->errors = [];
        
        $basic = $this->data['basic'];
        
        // 必須項目チェック
        $requiredFields = [
            'hos_cd' => '医療機関コード',
            'hos_name' => '医療機関名',
            'zipcode' => '郵便番号',
            'pre' => '都道府県',
        ];
        
        foreach ($requiredFields as $field => $label) {
            if (empty($basic[$field])) {
                $this->errors[] = $label . 'が未入力です';
            }
        }
        
        // 地域コード・地域チェック
        if (empty($basic['are_cd'])) {
            $this->errors[] = '地区コードが未入力です';
        }
        if (empty($basic['area'])) {
            $this->errors[] = '地域が未入力です';
        }
        
        // 医療機関コード重複チェック
        if (!empty($basic['hos_cd'])) {
            if ($this->isDuplicateHosCd($basic['hos_cd'])) {
                $this->errors[] = 'その医療機関コードはすでに登録されています。';
            }
        }
        
        return empty($this->errors);
    }
    
    /**
     * 医療機関コード重複チェック
     */
    private function isDuplicateHosCd($hos_cd) {
        $sql = "SELECT COUNT(*) as cnt FROM main WHERE hos_cd = :hos_cd";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['cnt'] > 0;
    }
    
    /**
     * エラーメッセージを取得
     */
    public function getErrors() {
        return $this->errors;
    }
    
    /**
     * データを取得
     */
    public function getData() {
        return $this->data;
    }
    
    /**
     * データを配列展開（ビュー互換性用）
     */
    public function getExtractArray() {
        $extract = [];
        
        // 全カテゴリをフラット化
        foreach ($this->data as $category => $items) {
            if (is_array($items)) {
                $extract = array_merge($extract, $items);
            }
        }
        
        return $extract;
    }
}
?>
