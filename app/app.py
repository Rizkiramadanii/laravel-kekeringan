from flask import Flask, request, jsonify
import joblib
import numpy as np

import matplotlib
matplotlib.use('Agg')  # FIX untuk error tkinter/threading
import matplotlib.pyplot as plt

import io
import base64
import warnings
import traceback


warnings.filterwarnings("ignore")

app = Flask(__name__)

# Load model dan scaler
xgb_model = joblib.load('C:\\laragon\\www\\kekeringan\\app\\Models\\kekeringan2_model_xgb.pkl')
lgbm_model = joblib.load('C:\\laragon\\www\\kekeringan\\app\\Models\\kekeringan2_model_lgb.pkl')
catboost_model = joblib.load('C:\\laragon\\www\\kekeringan\\app\\Models\\kekeringan2_model_catboost.pkl')
voting_clf = joblib.load('C:\\laragon\\www\\kekeringan\\app\\Models\\kekeringan2_model_voting.pkl')
scaler = joblib.load('C:\\laragon\\www\\kekeringan\\app\\Models\\scaler_xgb.pkl')
label_mapping = joblib.load('C:\\laragon\\www\\kekeringan\\app\\Models\\label_mapping.pkl')
reverse_mapping = {v: k for k, v in label_mapping.items()}

models = {
    'XGBoost': xgb_model,
    'LightGBM': lgbm_model,
    'CatBoost': catboost_model,
    'Voting Ensemble': voting_clf
}

@app.route('/')
def home():
    return "Welcome to the Drought Prediction API"

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.json

        # === Validasi Input ===
        expected_keys = []
        for i in range(1, 3 + 1):
            expected_keys.extend([
                f'SPI_3bulan_{i}',
                f'curahhujan_3month_{i}',
                f'Suhu_Maksimum_{i}',
                f'Suhu_RataRata_{i}',
                f'Suhu_Minimum_{i}',
                f'Curah_Hujan_{i}',
                f'Lama_Penyinaran_Matahari_Persen_{i}'
            ])
        missing_keys = [key for key in expected_keys if key not in data]
        if missing_keys:
            return jsonify({'error': f'Missing input fields: {missing_keys}'}), 400

        # === Proses Input ===
        input_values = []
        for i in range(1, 4):
            input_values.extend([
                float(data[f'SPI_3bulan_{i}']),
                float(data[f'curahhujan_3month_{i}']),
                float(data[f'Suhu_Maksimum_{i}']),
                float(data[f'Suhu_RataRata_{i}']),
                float(data[f'Suhu_Minimum_{i}']),
                float(data[f'Curah_Hujan_{i}']),
                float(data[f'Lama_Penyinaran_Matahari_Persen_{i}'])
            ])

        data_scaled = scaler.transform([input_values])
        results = {}
        probabilities = {}

        # === Prediksi oleh semua model ===
        for name, model in models.items():
            pred_encoded = model.predict(data_scaled)[0]
            pred_label = reverse_mapping[int(pred_encoded)]
            pred_proba = model.predict_proba(data_scaled)[0]

            results[name] = {
                'label': pred_label,
                'confidence': round(float(pred_proba[int(pred_encoded)]) * 100, 2)
            }

            probabilities[name] = {
                reverse_mapping[i]: round(float(prob) * 100, 2) for i, prob in enumerate(pred_proba)
            }

        # === Generate chart ===
        fig, axs = plt.subplots(2, 2, figsize=(12, 10))
        axs = axs.flatten()
        for idx, (model_name, prob_dict) in enumerate(probabilities.items()):
            labels = list(prob_dict.keys())
            values = list(prob_dict.values())
            axs[idx].bar(labels, values)
            axs[idx].set_ylim(0, 100)
            axs[idx].set_title(model_name)
            axs[idx].tick_params(axis='x', rotation=45)

        for i in range(len(probabilities), len(axs)):
            fig.delaxes(axs[i])

        plt.tight_layout()
        buf = io.BytesIO()
        plt.savefig(buf, format='png')
        buf.seek(0)
        chart_img = base64.b64encode(buf.read()).decode('utf-8')
        plt.close()

        return jsonify({
            'status': 'success',
            'predictions': results,
            'probabilities': probabilities,
            'chart': chart_img
        })

    except Exception as e:
        traceback.print_exc()
        return jsonify({'status': 'error', 'message': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
