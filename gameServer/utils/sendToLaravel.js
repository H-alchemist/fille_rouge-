import axios from 'axios';

export async function sendToLaravel(data) {
  try {
    const response = await axios.post('http://localhost:8000/api/partie', data);
    console.log('Sent to Laravel:', response.data);
  } catch (error) {
    console.error('Failed to send to Laravel:', error.message);
  }
}
