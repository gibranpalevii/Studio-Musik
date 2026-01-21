import { db } from "./db.js";

export default async function handler(req, res) {
  try {
    const [rows] = await db.query("SELECT * FROM musik");
    res.status(200).json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
}
